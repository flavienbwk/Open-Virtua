<?php

class apiModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    protected function checkUserTokenCredentials($user_id, $token_id) {
        $userModel = new userModel($this->_Page, $this->_bdd);
        $tokenModel = new tokenModel($this->_Page, $this->_bdd);
        if (substr($token_id, 0, 6) == "login_") {
            $add = ($this->_Page->getConfigVar("check_token_expiration")) ? " AND expiration>=?" : "";
            $query = $this->_bdd->prepare("SELECT * FROM Token WHERE ids=? AND User_ids=?" . $add);
            if (!empty($add)) {
                $query->execute([$token_id, $user_id, time()]);
            } else {
                $query->execute([$token_id, $user_id]);
            }
            if ($query->rowCount()) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generateApiKey($ids_user) {
        return sha1($this->hashApiFromUserIds($ids_user) . time());
    }

    public function getUserApiKey($id) {
        $query = $this->_bdd->prepare("SELECT * FROM User WHERE id=?");
        $query->execute([$id]);
        if ($query->rowCount()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getApiKey($api_key) {
        $query = $this->_bdd->prepare("SELECT * FROM User WHERE api_key=?");
        $query->execute([$api_key]);
        if ($query->rowCount()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getMasterApiKey() {
        return $this->_Page->getConfigVar("api_key_master");
    }

    public function isIpAuthorized($ip) {
        if ($this->_Page->getConfigVar("ip_check")) {
            if (in_array($ip, $this->_Page->getConfigVar("ip_authorized"))) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function create($table, $parameters) {
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

    public function update($table, $array) {
        $i = 0;
        $parameters = "";
        $array_keys = array_keys($array);

        while ($i < sizeof($array)) {
            $name = $array_keys[$i];
            $parameters .= ($i == sizeof($array) - 1) ? $name . "=" . ":" . $name : $name . "=" . ":" . $name . ",";
            $i++;
        }

        $query = $this->_bdd->prepare("UPDATE $table SET " . $parameters . " WHERE article_ids=:article_ids");
        $query->execute($array);
        return $query;
    }

    protected function formatReturn($error_code, $message, $result = null) {
        return ["error" => $error_code, "message" => $message, "results" => $result];
    }

}

?>