<?php

class slaveModel extends apiModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function getSlavePreseeds($slave_id) {
        $query = $this->_bdd->prepare("SELECT * FROM Slave_has_Preseed WHERE Slave_id=?");
        $query->execute([$slave_id]);
        if ($query->rowCount()) {
            $preseeds_slave = $query->fetchAll(PDO::FETCH_ASSOC);
            $preseeds = [];
            foreach ($preseeds_slave as $preseed_slave) {
                array_push($preseeds, $preseed_slave);
            }

            return (!empty($preseeds)) ? $preseeds : false;
        } else {
            return false;
        }
    }

    public function getSlaveBy($data = false) {
        $parameters = " WHERE";
        $counter = 0;
        $data = ($data) ? $data : [];
        foreach ($data as $item => $value) {
            if (!$counter)
                $parameters .= " `" . $item . "`='" . $value . "'";
            else
                $parameters .= " AND `" . $item . "`='" . $value . "'";
            $counter++;
        }

        $parameters = ($data) ? $parameters : "";
        $query = $this->_bdd->prepare("SELECT * FROM Slave" . $parameters);
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