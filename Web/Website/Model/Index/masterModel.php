<?php

class masterModel extends apiModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function getMasterBy($data = false) {
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
        $query = $this->_bdd->prepare("SELECT * FROM Master" . $parameters);
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

}
?>