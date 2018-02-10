<?php

use phpseclib\Net\SSH2;

class apiPostModel extends apiModel {

    var $_bdd, $_Page;
    private $_requests = [];
    private $_parameters = null;
    private $_checkname = null;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function checkRequest($parameters) {
        $this->_parameters = $parameters;
        if (isset($_GET["parameters"])) {
            if ($this->is_in(["login", "check"], $_GET["parameters"])) {
                $this->_checkname = "loginCheckValidity";
                return true;
            } else if ($this->is_in(["login"], $_GET["parameters"])) {
                $this->_checkname = "loginUser";
                return true;
            } else if ($this->is_in(["register"], $_GET["parameters"])) {
                $this->_checkname = "registerUser";
                return true;
            } else if ($this->is_in(["master", "list"], $_GET["parameters"])) {
                $this->_checkname = "masterList";
                return true;
            } else if ($this->is_in(["master", "add"], $_GET["parameters"])) {
                $this->_checkname = "masterAdd";
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function execute() {
        $method = $this->_checkname;
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            return $this->formatReturn(false, "Inexistant function. Please contact the support.");
        }
    }

    /**
     * Check if the parameters are present, in the right order.
     * 
     * @param type $parameters Array of strings to search in array.
     * @param type $data The array where to find the strings.
     * @return boolean
     */
    private function is_in($parameters, $data) {
        $count = 0;

        for ($i = 0; $i < sizeof($parameters); $i++) {
            if (isset($data[$i]) && $parameters[$i] == $data[$i]) {
                $count++;
            } else {
                break;
            }
        }

        return ($count == sizeof($parameters)) ? true : false;
    }

    private function is_in_array($strings, $array) {
        $all_valid = true;
        foreach ($strings as $string) {
            if (!isset($array[$string])) {
                $all_valid = false;
                break;
            }
        }
        return $all_valid;
    }

    private function masterAdd() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    if ($this->is_in_array(["name", "ip", "username", "password"], $this->_parameters)) {
                        $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);

                        if (isset($this->_parameters["ssh_port"])) {
                            if (!(preg_match($this->_Page->getConfigVar("pattern_port", $this->_parameters["ssh_port"])))) {
                                return $this->formatReturn(true, "Invalid SSH port provided.");
                            }
                            $ssh_port = $this->_parameters["ssh_port"];
                        } else {
                            $ssh_port = 22;
                        }

                        if (empty($this->_parameters["ip"])) {
                            return $this->formatReturn(true, "Invalid IP provided.");
                        }
                        $ip = $this->_parameters["ip"];
                        if (!$masterModel->getMasterBy(["ip" => $ip, "ssh_port" => $ssh_port])) {

                            if (isset($this->_parameters["memory"]) && !is_numeric($this->_parameters["memory"]) && intval($this->_parameters["memory"]) > 0) {
                                return $this->formatReturn(true, "Invalid memory value provided.");
                            }
                            $memory = (isset($this->_parameters["memory"])) ? intval($this->_parameters["memory"]) : 0;

                            if (isset($this->_parameters["storage"]) && !is_numeric($this->_parameters["storage"]) && intval($this->_parameters["storage"]) > 0) {
                                return $this->formatReturn(true, "Invalid storage value provided.");
                            }
                            $storage = (isset($this->_parameters["storage"])) ? intval($this->_parameters["storage"]) : 0;
                            $username = $this->_parameters["username"];
                            $password = $this->_parameters["password"];
                            $ip = $this->_parameters["ip"];

                            if ($servermanagerModel->isSshValid($ip, $ssh_port, $username, $password)) {
                                $connection = ssh2_connect($ip, $ssh_port);
                                ssh2_auth_password($connection, $username, $password);

                                // Checking memory size.
                                if ($memory == 0) {
                                    $stream = ssh2_exec($connection, 'cat /proc/meminfo | grep MemTotal');
                                    stream_set_blocking($stream, true);
                                    $stream_out = stream_get_contents($stream);
                                    if (!empty($stream_out)) {
                                        preg_match_all("#([0-9]{1,})#", trim($stream_out), $output);
                                        if (isset($output[0][0]) && is_numeric($output[0][0])) {
                                            $memory = floor(intval($output[0][0]) / 1000);
                                        } else {
                                            return $this->formatReturn(true, "Invalid memory size returned from the server.");
                                        }
                                    } else {
                                        return $this->formatReturn(true, "Impossible to get the memory size for your server (empty response).");
                                    }
                                }

                                // Checking storage size.
                                if ($storage == 0) {
                                    $stream = ssh2_exec($connection, 'echo $(($(stat -f --format="%a*%S" .)))');
                                    stream_set_blocking($stream, true);
                                    $stream_out = trim(stream_get_contents($stream));
                                    if (!empty($stream_out)) {
                                        if (is_numeric($stream_out)) {
                                            $storage = floor(intval($stream_out) / 1000000);
                                        } else {
                                            return $this->formatReturn(true, "Invalid storage size returned from the server.");
                                        }
                                    } else {
                                        return $this->formatReturn(true, "Impossible to get the available storage size for your server (empty response).");
                                    }
                                }

                                $query = $this->create("Master", [
                                    "name" => $this->_parameters["name"],
                                    "ip" => $ip,
                                    "ssh_port" => $ssh_port,
                                    "username" => $username,
                                    "password" => $this->_Page->f_crypt($this->_Page->getConfigVar("master_password"), $password),
                                    "memory" => $memory,
                                    "storage" => $storage,
                                    "User_id" => $pure_id
                                ]);

                                if ($query) {
                                    return $this->formatReturn(false, "Master machine successfuly created.", []);
                                } else {
                                    return $this->formatReturn(true, "An error occured while creating your master machine.");
                                }
                            } else {
                                return $this->formatReturn(true, "Connection failed. Invalid credentials or host.");
                            }
                        } else {
                            return $this->formatReturn(true, "A machine with this IP and SSH port already exist.");
                        }
                    } else {
                        return $this->formatReturn(true, "Please fill all the fields.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials.");
        }
    }

    private function masterList() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $query = $this->_bdd->prepare("SELECT * FROM Master WHERE User_id=?");
                    $query->execute([$pure_id]);
                    if ($query->rowCount()) {
                        $to_return = [];
                        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
                            array_push($to_return, [
                                "master_id" => $data["id"],
                                "name" => $data["name"],
                                "ip" => $data["ip"]
                            ]);
                        }
                        return $this->formatReturn(false, "One or more master machine found.", ["list" => $to_return]);
                    } else {
                        return $this->formatReturn(false, "No master machine found.", ["list" => []]);
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials.");
        }
    }

    private function loginCheckValidity() {
        if (isset($this->_parameters["token_id"]) && isset($this->_parameters["user_id"])) {
            $tokenModel = new tokenModel($this->_Page, $this->_bdd);
            $query_token = $tokenModel->isTokenValid($this->_parameters["token_id"], $this->_parameters["user_id"]);
            if ($query_token) {
                return $this->formatReturn(false, "Authorization provided : valid token.", ["expiration" => intval($query_token["expiration"])]);
            } else {
                return $this->formatReturn(true, "Unauthorized user token (inexistant or expired).");
            }
        } else {
            return $this->formatReturn(true, "Inexistant user token parameter.");
        }
    }

    private function loginUser() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if (isset($this->_parameters["username"]) && isset($this->_parameters["password"])) {
            $user_query = $userModel->getUserBy([
                "username" => $this->_parameters["username"],
                "password" => $userModel->hashPassword($this->_parameters["password"])
            ]);
            if ($user_query) {
                $tokenModel = new tokenModel($this->_Page, $this->_bdd);
                $query_token = $tokenModel->createToken($user_query["ids"], "login");
                if ($query_token) {
                    $response = [
                        "user_id" => $user_query["ids"],
                        "token_id" => $query_token["ids"],
                        "expiration" => $query_token["expiration"]
                    ];
                    return $this->formatReturn(false, "Authorization provided.", $response);
                } else {
                    return $this->formatReturn(true, "An error occured while generating the connection token.");
                }
            } else {
                return $this->formatReturn(true, "Wrong credentials.");
            }
        } else {
            return $this->formatReturn(true, "Please fill all the fields.");
        }
    }

    private function registerUser() {
        if ($this->is_in_array([
                    "username",
                    "password"
                        ], $this->_parameters)) {
            $userModel = new userModel($this->_Page, $this->_bdd);
            if (strlen($this->_parameters["password"]) >= 4) {
                if (strlen($this->_parameters["username"]) >= 2) {
                    $query_check = $userModel->getUserBy(["username" => $this->_parameters["username"]]);
                    if (!$query_check) {
                        if (!isset($this->_parameters["phonenumber"]) || (preg_match($this->_Page->getConfigVar("pattern_phonenumber"), $this->_parameters["phonenumber"]))) {
                            if (!isset($this->_parameters["email"]) || (preg_match($this->_Page->getConfigVar("pattern_emailaddress"), $this->_parameters["email"]))) {
                                $valid = true;
                                if (isset($this->_parameters["phonenumber"])) {
                                    $query_check = $userModel->getUserBy(["phonenumber" => $this->_parameters["phonenumber"]]);
                                    $valid = ($query_check) ? $valid : false;
                                    $phonenumber = ($valid) ? $this->_parameters["phonenumber"] : "";
                                } else {
                                    $phonenumber = "";
                                }
                                if (isset($this->_parameters["email"])) {
                                    $query_check = $userModel->getUserBy(["email" => $this->_parameters["email"]]);
                                    $valid = ($query_check) ? $valid : false;
                                    $email = ($valid) ? $this->_parameters["email"] : "";
                                } else {
                                    $email = "";
                                }
                                $username = $this->_parameters["username"];
                                $password = $userModel->hashPassword($this->_parameters["password"]);
                                if ($valid) {
                                    $ids = $userModel->generateIds([$username, $password]);
                                    if ($ids) {
                                        $query_create = $this->create("User", [
                                            "ids" => $ids,
                                            "username" => $username,
                                            "password" => $password,
                                            "email" => $email,
                                            "phonenumber" => $phonenumber
                                        ]);

                                        if ($query_create) {
                                            return $this->formatReturn(false, "Successfuly registered.", [
                                                        "username" => $username
                                            ]);
                                        } else {
                                            return $this->formatReturn(true, "An error occured while creating your account.");
                                        }
                                    } else {
                                        return $this->formatReturn(true, "Failed to attribute an id, please try agian.");
                                    }
                                } else {
                                    return $this->formatReturn(true, "The email address or phone number you've specified already exists.");
                                }
                            } else {
                                return $this->formatReturn(true, "The email address you've specified is invalid. Please use a valid format.");
                            }
                        } else {
                            return $this->formatReturn(true, "The phone number you've specified is invalid. Please use international format.");
                        }
                    } else {
                        return $this->formatReturn(true, "The username you've specified already exists.");
                    }
                } else {
                    return $this->formatReturn(true, "The username must be at least 2 characters.");
                }
            } else {
                return $this->formatReturn(true, "The password must be at least 4 characters.");
            }
        } else {
            return $this->formatReturn(true, "Please fill all the fields.");
        }
    }

}
