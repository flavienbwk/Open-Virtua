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
            } else if ($this->is_in(["master", "details"], $_GET["parameters"])) {
                $this->_checkname = "masterDetails";
                return true;
            } else if ($this->is_in(["master", "update"], $_GET["parameters"])) {
                $this->_checkname = "masterUpdate";
                return true;
            } else if ($this->is_in(["hypervisor", "list"], $_GET["parameters"])) {
                $this->_checkname = "hypervisorList";
                return true;
            } else if ($this->is_in(["hypervisor", "distributions"], $_GET["parameters"])) {
                $this->_checkname = "hypervisorDistributions";
                return true;
            } else if ($this->is_in(["distribution", "preseeds"], $_GET["parameters"])) {
                $this->_checkname = "distributionPreseeds";
                return true;
            } else if ($this->is_in(["bootup", "iamalive"], $_GET["parameters"])) {
                $this->_checkname = "bootupIamalive";
                return true;
            } else if ($this->is_in(["preseed", "create"], $_GET["parameters"])) {
                $this->_checkname = "preseedCreate";
                return true;
            } else if ($this->is_in(["preseed", "remove"], $_GET["parameters"])) {
                $this->_checkname = "preseedRemove";
                return true;
            } else if ($this->is_in(["slave", "list"], $_GET["parameters"])) {
                $this->_checkname = "slaveList";
                return true;
            } else if ($this->is_in(["slave", "details"], $_GET["parameters"])) {
                $this->_checkname = "slaveDetails";
                return true;
            } else if ($this->is_in(["slave", "preseeds", "add"], $_GET["parameters"])) {
                $this->_checkname = "slavePreseedsAdd";
                return true;
            } else if ($this->is_in(["slave", "preseeds", "remove"], $_GET["parameters"])) {
                $this->_checkname = "slavePreseedsRemove";
                return true;
            } else if ($this->is_in(["slave", "preseeds"], $_GET["parameters"])) {
                $this->_checkname = "slavePreseedsList";
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

    private function slavePreseedsRemove() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        $slaveModel = new slaveModel($this->_Page, $this->_bdd);
        $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id", "slave_id", "preseed_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $master = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"]]);
                    if ($master) {
                        $slave = $slaveModel->getSlaveBy(["id" => $this->_parameters["slave_id"]]);
                        if ($slave) {
                            $preseed_query = $this->_bdd->prepare("SELECT id FROM Slave_has_Preseed WHERE Slave_id=? AND Preseed_id=?");
                            $preseed_query->execute([$this->_parameters["slave_id"], $this->_parameters["preseed_id"]]);
                            if ($preseed_query->rowCount()) {
                                if ($this->remove("Slave_has_Preseed", [
                                            "Slave_id" => $slave["id"],
                                            "Preseed_id" => $this->_parameters["preseed_id"]
                                        ])) {
                                    return $this->formatReturn(false, "Successfuly removed.");
                                } else {
                                    return $this->formatReturn(true, "Impossible to remove this slave for the moment.");
                                }
                            } else {
                                return $this->formatReturn(true, "Invalid preseed ID to remove (inexistant).");
                            }
                        } else {
                            return $this->formatReturn(true, "Invalid slave ID.");
                        }
                    } else {
                        return $this->formatReturn(true, "Invalid master ID.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function slavePreseedsAdd() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        $slaveModel = new slaveModel($this->_Page, $this->_bdd);
        $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id", "slave_id", "preseed_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $master = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"]]);
                    if ($master) {
                        $slave = $slaveModel->getSlaveBy(["id" => $this->_parameters["slave_id"]]);
                        if ($slave) {
                            $preseed = $hypervisorModel->getPreseedBy(["id" => $this->_parameters["preseed_id"]]);
                            if ($preseed) {
                                $query_exist = $this->_bdd->prepare("SELECT id FROM Slave_has_Preseed WHERE Slave_id=? AND Preseed_id=?");
                                $query_exist->execute([$this->_parameters["slave_id"], $this->_parameters["preseed_id"]]);
                                if (!$query_exist->rowCount()) {
                                    $query_last_preseed = $this->_bdd->prepare("SELECT * FROM Slave_has_Preseed WHERE Slave_id=? ORDER BY execution_order DESC LIMIT 1");
                                    $query_last_preseed->execute([$this->_parameters["slave_id"]]);
                                    if ($query_last_preseed->rowCount()) {
                                        $last_preseed = $query_last_preseed->fetch(PDO::FETCH_ASSOC);
                                    } else {
                                        $last_preseed = ["execution_order" => 0];
                                    }

                                    if (isset($this->_parameters["execution_order"])) {
                                        if (intval($this->_parameters["execution_order"]) >= 0) {
                                            $execution_order = $this->_parameters["execution_order"];
                                        } else {
                                            return $this->formatReturn(true, "Invalid value provided for execution order.");
                                        }
                                    } else {
                                        $execution_order = 99999;
                                    }

                                    $this->_bdd->beginTransaction();
                                    $execution_order = intval($execution_order);
                                    $last_preseed_order = intval($last_preseed["execution_order"]);
                                    if ($last_preseed_order <= $execution_order) {
                                        $execution_order = $last_preseed_order + 1;
                                    } else {
                                        // Update last preseed order.
                                        $execution_order = $last_preseed_order;
                                        $query = $this->_bdd->prepare("UPDATE Slave_has_Preseed SET execution_order=? WHERE Preseed_id=?");
                                        $query->execute([($last_preseed_order + 1), $last_preseed["Preseed_id"]]);
                                    }

                                    if ($this->create("Slave_has_Preseed", [
                                                "Slave_id" => $this->_parameters["slave_id"],
                                                "Preseed_id" => $this->_parameters["preseed_id"],
                                                "execution_order" => $execution_order,
                                                "executed" => 0
                                            ])) {
                                        $this->_bdd->commit();
                                        return $this->formatReturn(false, "Successfuly added.");
                                    } else {
                                        $this->_bdd->rollBack();
                                        return $this->formatReturn(true, "An error occured while inserting the new preseed.");
                                    }
                                } else {
                                    return $this->formatReturn(true, "This preseed already exist for this slave.");
                                }
                            } else {
                                return $this->formatReturn(true, "Invalid preseed ID.");
                            }
                        } else {
                            return $this->formatReturn(true, "Invalid slave ID.");
                        }
                    } else {
                        return $this->formatReturn(true, "Invalid master ID.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function slavePreseedsList() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        $slaveModel = new slaveModel($this->_Page, $this->_bdd);
        $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id", "slave_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $master = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"]]);
                    if ($master) {
                        $slave = $slaveModel->getSlaveBy(["id" => $this->_parameters["slave_id"]]);
                        if ($slave) {
                            $processed = [];
                            $preseeds = $slaveModel->getSlavePreseeds($slave["id"]);
                            if ($preseeds) {
                                $message = "";
                                foreach ($preseeds as $preseed) {
                                    array_push($processed, [
                                        "preseed_id" => $preseed["Preseed_id"],
                                        "execution_order" => $preseed["execution_order"],
                                        "executed" => $preseed["executed"]
                                    ]);
                                }
                            } else {
                                $message = "No preseed found.";
                            }

                            return $this->formatReturn(false, $message, [
                                        "list" => $processed
                            ]);
                        } else {
                            return $this->formatReturn(true, "Invalid slave ID.");
                        }
                    } else {
                        return $this->formatReturn(true, "Invalid master ID.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function slaveDetails() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        $slaveModel = new slaveModel($this->_Page, $this->_bdd);
        $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id", "slave_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $master = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"], "User_id" => $pure_id]);
                    if ($master) {
                        $data = $slaveModel->getSlaveBy(["id" => $this->_parameters["master_id"], "id" => $this->_parameters["slave_id"]]);
                        if ($data) {
                            $distribution_data = $hypervisorModel->getDistributionBy(["id" => $data["Distribution_id"]]);
                            $distribution_name = ($distribution_data) ? $distribution_data["name"] : "";

                            $hypervisor_data = $hypervisorModel->getHypervisorByDistributionId($data["Distribution_id"]);
                            $hypervisor_name = ($hypervisor_data) ? $hypervisor_data["name"] : "";
                            return $this->formatReturn(false, "Here are the details.", [
                                        "name" => $data["name"],
                                        "ip" => $data["ip"],
                                        "distribution_name" => $distribution_name,
                                        "distribution_id" => $distribution_data["id"],
                                        "hypervisor_name" => $hypervisor_name,
                                        "hypervisor_id" => $hypervisor_data["id"],
                                        "ssh_port" => $data["ssh_port"],
                                        "memory" => $data["memory"],
                                        "storage" => $data["storage"],
                                        "mac" => $data["mac"],
                                        "gateway" => $data["gateway"],
                                        "date" => $data["date"]
                            ]);
                        } else {
                            return $this->formatReturn(true, "No slave found for this ID.");
                        }
                    } else {
                        return $this->formatReturn(true, "No master found for this ID.");
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

    private function slaveList() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $masterModel = new masterModel($this->_Page, $this->_bdd);
                    $master = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"]]);
                    if ($master) {
                        $slaveModel = new slaveModel($this->_Page, $this->_bdd);
                        $slaves = $slaveModel->getSlaveBy();
                        $processed = [];
                        if ($slaves) {
                            $message = "";
                            foreach ($slaves as $slave) {
                                array_push($processed, [
                                    "slave_id" => $slave["id"],
                                    "name" => $slave["name"],
                                    "ip" => $slave["ip"],
                                    "ssh_port" => $slave["ssh_port"]
                                ]);
                            }
                        } else {
                            $message = "No slave found.";
                        }

                        return $this->formatReturn(false, $message, [
                                    "list" => $processed
                        ]);
                    } else {
                        return $this->formatReturn(true, "Invalid master ID.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function bootupIamalive() {
        if ($this->is_in_array(["password_user", "password_root", "ip", "ssh_port"], $this->_parameters)) {
            $email_address = "kezal_r@etna-alternance.net";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // En-têtes additionnels
            $headers .= 'To: Rostan <' . $email_address . '>' . "\r\n";
            $headers .= 'From: Open Virtua <no-reply@openvirtua.com>' . "\r\n";
            $email_text = "Hello Rostan,<br/>"
                    . "<br/>"
                    . "Herer are your credentials :<br/>"
                    . "IP: <b>" . $this->_parameters["ip"] . "</b><br/>"
                    . "SSH port: <b>" . $this->_parameters["ssh_port"] . "</b><br/>"
                    . "User: <b>rostan</b><br/>"
                    . "User password: <b>" . $this->_parameters["password_user"] . "</b><br/>"
                    . "Root password: <b>" . $this->_parameters["password_root"] . "</b><br/>";

            if (mail($email_address, "Your VM credentials", $email_text, $headers)) {
                return $this->formatReturn(false, "Email sent.");
            } else {
                return $this->formatReturn(true, "Email failed to send.");
            }
        } else {
            return $this->formatReturn(true, "Please provide all the fields.");
        }
    }

    private function preseedCreate() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "distribution_id", "name", "script"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
                    $distribution = $hypervisorModel->getDistributionBy(["id" => $this->_parameters["distribution_id"]]);
                    if ($distribution) {
                        $query_preseed = $hypervisorModel->getPreseedBy(["name" => $this->_parameters["name"]]);
                        if (!$query_preseed) {
                            $query_create = $this->create("Preseed", [
                                "name" => $this->_parameters["name"],
                                "script" => $this->_parameters["script"],
                                "Distribution_id" => $this->_parameters["distribution_id"]
                            ]);
                            if ($query_create) {
                                return $this->formatReturn(false, "Preseed successfuly created.", [
                                            "preseed_id" => $this->_bdd->lastInsertId(),
                                            "name" => $this->_parameters["name"]
                                ]);
                            } else {
                                return $this->formatReturn(true, "An error occured while creating your preseed.");
                            }
                        } else {
                            return $this->formatReturn(true, "This preseed name already exist. Please choose another one.");
                        }
                    } else {
                        return $this->formatReturn(true, "This distribution doesn't exist.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function preseedRemove() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "preseed_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
                    $query_preseed = $hypervisorModel->getPreseedBy(["id" => $this->_parameters["preseed_id"]]);
                    if ($query_preseed) {
                        $query_remove = $this->remove("Preseed", ["id" => $this->_parameters["preseed_id"]]);
                        $query_remove_associations = $this->remove("Slave_has_Preseed", ["Preseed_id" => $this->_parameters["preseed_id"]]);
                        if ($query_remove) {
                            return $this->formatReturn(false, "Preseed successfuly removed.", []);
                        } else {
                            return $this->formatReturn(true, "An error occured while removing your preseed.");
                        }
                    } else {
                        return $this->formatReturn(true, "This preseed does not exist.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function distributionPreseeds() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "distribution_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
                    $distribution = $hypervisorModel->getDistributionBy(["id" => $this->_parameters["distribution_id"]]);
                    if ($distribution) {
                        $preseeds = $hypervisorModel->getDistributionPreseeds($this->_parameters["distribution_id"]);
                        if ($preseeds) {
                            $processed = [];
                            foreach ($preseeds as $preseed) {
                                array_push($processed, [
                                    "preseed_id" => $preseed["id"],
                                    "name" => $preseed["name"],
                                    "script" => $preseed["script"],
                                    "archive_status" => $preseed["archive_status"]
                                ]);
                            }
                            return $this->formatReturn(false, "", [
                                        "list" => $processed
                            ]);
                        } else {
                            return $this->formatReturn(true, "No preseed available for this distribution.", []);
                        }
                    } else {
                        return $this->formatReturn(true, "This distribution doesn't exist.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function hypervisorList() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
                    $hypervisors = $hypervisorModel->getHypervisorBy();
                    if ($hypervisors) {
                        $processed = [];
                        foreach ($hypervisors as $hypervisor) {
                            array_push($processed, [
                                "hypervisor_id" => $hypervisor["id"],
                                "name" => $hypervisor["name"],
                                "description" => $hypervisor["description"],
                                "pxe_eligible" => $hypervisor["pxe_eligible"],
                                "available" => $hypervisor["available"]
                            ]);
                        }
                        return $this->formatReturn(false, "", [
                                    "list" => $processed
                        ]);
                    } else {
                        return $this->formatReturn(true, "No hypervisors available.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function hypervisorDistributions() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "hypervisor_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $hypervisorModel = new hypervisorModel($this->_Page, $this->_bdd);
                    $hypervisor = $hypervisorModel->getHypervisorBy(["id" => $this->_parameters["hypervisor_id"]]);
                    if ($hypervisor) {
                        $hv_distributions = $hypervisorModel->getHypervisorDistributions($this->_parameters["hypervisor_id"]);
                        if ($hv_distributions) {
                            $processed = [];
                            foreach ($hv_distributions as $hv_distribution) {
                                $distribution = $hypervisorModel->getDistributionBy(["id" => $hv_distribution["Distribution_id"]]);
                                if ($distribution) {
                                    array_push($processed, [
                                        "distribution_id" => $distribution["id"],
                                        "distribution_name" => $distribution["name"],
                                        "distribution_description" => $distribution["description"],
                                        "details" => $hv_distribution["details"]
                                    ]);
                                }
                            }

                            if (!empty($processed)) {
                                return $this->formatReturn(false, "", [
                                            "list" => $processed
                                ]);
                            } else {
                                return $this->formatReturn(true, "No distribution available for this hypervisor (2).");
                            }
                        } else {
                            return $this->formatReturn(true, "No distribution available for this hypervisor (1).");
                        }
                    } else {
                        return $this->formatReturn(true, "This hypervisor doesn't exist.");
                    }
                } else {
                    return $this->formatReturn(true, "Impossible to get the ID from the IDS.");
                }
            } else {
                return $this->formatReturn(true, "Unauthorized token ID or user ID.");
            }
        } else {
            return $this->formatReturn(true, "Please provided the authentication credentials or check you've filled all the fields.");
        }
    }

    private function masterDetails() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $masterModel = new masterModel($this->_Page, $this->_bdd);
                    $data = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"], "User_id" => $pure_id]);
                    if ($data) {
                        if ($masterModel->updateMemory($this->_parameters["master_id"])) {
                            if ($masterModel->updateStorage($this->_parameters["master_id"])) {
                                return $this->formatReturn(false, "Here are the details.", [
                                            "master_id" => $this->_parameters["master_id"],
                                            "user_id" => $this->_parameters["user_id"],
                                            "name" => $data["name"],
                                            "ip" => $data["ip"],
                                            "memory" => $data["memory"],
                                            "storage" => $data["storage"]
                                ]);
                            } else {
                                return $this->formatReturn(true, "Impossible to update the storages of this server.");
                            }
                        } else {
                            return $this->formatReturn(true, "Impossible to update the memory of this server.");
                        }
                    } else {
                        return $this->formatReturn(true, "No master found for this ID.");
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

    private function masterUpdate() {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $masterModel = new masterModel($this->_Page, $this->_bdd);
        $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);
        if ($this->is_in_array(["user_id", "token_id", "master_id"], $this->_parameters)) {
            if ($this->checkUserTokenCredentials($this->_parameters["user_id"], $this->_parameters["token_id"])) {
                $pure_id = $userModel->getIdByIds($this->_parameters["user_id"]);
                if ($pure_id) {
                    $masterModel = new masterModel($this->_Page, $this->_bdd);
                    $data = $masterModel->getMasterBy(["id" => $this->_parameters["master_id"], "User_id" => $pure_id]);
                    if ($data) {
                        $master_id = $data["id"];
                        if (isset($this->_parameters["remove"]) && $this->_parameters["remove"] == "1") {
                            if ($masterModel->remove($master_id, $pure_id)) {
                                return $this->formatReturn(false, "Successfuly removed " . $data["name"] . ".");
                            } else {
                                return $this->formatReturn(true, "Impossible to remove this machine.");
                            }
                        } else {
                            if (isset($this->_parameters["ssh_port"])) {
                                if (!(preg_match($this->_Page->getConfigVar("pattern_port"), $this->_parameters["ssh_port"]))) {
                                    return $this->formatReturn(true, "Invalid SSH port provided.");
                                }

                                if ($masterModel->getMasterBy(["ip" => $data["ip"], "ssh_port" => $this->_parameters["ssh_port"]])) {
                                    return $this->formatReturn(true, "This machine already exist (IP and port).");
                                }

                                $ssh_port = $this->_parameters["ssh_port"];
                            } else {
                                $ssh_port = $data["ssh_port"];
                            }

                            if (isset($this->_parameters["username"]) && empty($this->_parameters["username"])) {
                                return $this->formatReturn(true, "Empty username value provided.");
                            }
                            $username = (isset($this->_parameters["username"])) ? $this->_parameters["username"] : $data["username"];
                            $password = (isset($this->_parameters["password"])) ? $this->_parameters["password"] : $this->_Page->f_decrypt($this->_Page->getConfigVar("master_password"), $data["password"]);
                            if (sizeof($this->_parameters) > 3) {
                                if ($servermanagerModel->isSshValid($data["ip"], $ssh_port, $username, $password)) {
                                    $masterModel->removeSlaves($master_id);
                                    $masterModel->updateMemory($master_id);
                                    $masterModel->updateStorage($master_id);

                                    if ($masterModel->update("Master", [
                                                "ssh_port" => $ssh_port,
                                                "username" => $username,
                                                "password" => $this->_Page->f_crypt($this->_Page->getConfigVar("master_password"), $password)
                                                    ], [
                                                "User_id" => $pure_id,
                                                "id" => $data["id"]
                                            ])) {
                                        return $this->formatReturn(false, "Successfuly updated.");
                                    } else {
                                        return $this->formatReturn(true, "Impossible to update for the moment.");
                                    }
                                } else {
                                    return $this->formatReturn(true, "Connection refused via SSH, update aborted.");
                                }
                            } else {
                                return $this->formatReturn(false, "Nothing to update.");
                            }
                        }
                    } else {
                        return $this->formatReturn(true, "No master found for this ID.");
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
                            if (!(preg_match($this->_Page->getConfigVar("pattern_port"), $this->_parameters["ssh_port"]))) {
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
                                    return $this->formatReturn(false, "Master machine successfuly created.", ["master_id" => $this->_bdd->lastInsertId()]);
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
                    $tokenModel->removeTokensByUserIds($user_query["ids"]);
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
                    "password",
                    "email"
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
