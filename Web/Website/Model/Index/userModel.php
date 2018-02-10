<?php

class userModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function hashPassword($password) {
        return sha1($password . $this->_Page->getConfigVar("master_password"));
    }

    public function generateIds($data) {
        $serialized = "";
        foreach ($data as $d) {
            $serialized .= $d;
        }
        return sha1($serialized . time() . uniqid());
    }

    /**
     * 
     * @param array $data
     * @return mixed Array if success. Else false.
     */
    public function getUserBy($data = false) {
        $parameters = " WHERE";
        $counter = 0;
        foreach ($data as $item => $value) {
            if (!$counter)
                $parameters .= " `" . $item . "`='" . $value . "'";
            else
                $parameters .= " AND `" . $item . "`='" . $value . "'";
            $counter++;
        }

        $parameters = ($data) ? $parameters : "";
        $query = $this->_bdd->prepare("SELECT * FROM User" . $parameters);
        $query->execute();
        if ($query->rowCount()) {
            if (!empty($parameters)) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            return false;
        }
    }

    public function getIdByIds($id) {
        $query = $this->getUserBy(["ids" => $id]);
        if ($query) {
            return $query["id"];
        } else {
            return false;
        }
    }

    public function sendMail($user_id, $subject, $message) {
        $user = $this->getUserBy(["id" => $user_id]);
        if ($user) {
            if (!empty($user["email"])) {
                mail($user["email"], $subject, $message);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

?>
