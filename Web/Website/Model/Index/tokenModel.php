<?php

class tokenModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    private function create($table, $parameters) {
        $i = 0;
        $parameters_formated = "";
        $parameters_name = "";
        $array_keys = array_keys($parameters);

        while ($i < sizeof($parameters)) {
            $name = $array_keys[$i];
            $val = $parameters[$name];
            $parameters_formated .= ($i == sizeof($parameters) - 1) ? ":" . $name : ":" . $name . ",";
            $parameters_name .= ($i == sizeof($parameters) - 1) ? $name : $name . ",";
            $i++;
        }

        $query = $this->_bdd->prepare("INSERT INTO $table (" . $parameters_name . ") VALUES (" . $parameters_formated . ")");
        $query->execute($parameters);
        return $query->rowCount();
    }

    public function getToken($id) {
        $query = $this->_bdd->prepare("SELECT * FROM Token WHERE id=?");
        $query->execute([$id]);
        if ($query->rowCount()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function createToken($user_ids, $description) {
        $token_name = "login_" . sha1(time() . uniqid());
        $time = time();
        $data = [
            "ids" => $token_name,
            "description" => $description,
            "date" => $time,
            "expiration" => $time + intval($this->_Page->getConfigVar("max_login_time")),
            "User_ids" => $user_ids,
            "ip" => $this->_Page->getIp()
        ];
        $query_token = $this->create("Token", $data);
        if ($query_token) {
            return $data;
        } else {
            return false;
        }
    }

    public function isTokenValid($token_ids, $user_ids) {
        if (!boolval($this->_Page->getConfigVar("check_token_expiration"))) {
            return true;
        }
        $query = $this->_bdd->prepare("SELECT * FROM Token WHERE ids=? AND expiration>? AND ip=? AND User_ids=?");
        $query->execute([$token_ids, time(), $this->_Page->getIp(), $user_ids]);
        if ($query->rowCount()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // DO NOT USE THIS.
    public function updateLoginToken($id) {
        $token = $this->getToken($id);
        if ($token) {
            if ($token["ip"] == $this->_Page->getIp()) {
                if (time() - intval($token["date"]) >= intval($this->_Page->getConfigVar("max_login_time"))) {
                    $query = $this->_bdd->prepare("UPDATE Token SET date=? WHERE id=?");
                    $query->execute([time(), $id]);
                    if ($query->rowCount()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function removeTokensByUserIds($user_ids) {
        if ($this->_Page->getConfigVar("check_token_expiration")) {
            $query = $this->_bdd->prepare("DELETE FROM Token WHERE User_ids=? AND expiration<=?");
            $query->execute([$user_ids, time()]);
            return $query->rowCount();
        } else {
            return true;
        }
    }

}
