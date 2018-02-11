<?php

class hypervisorModel extends apiModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function getHypervisorByDistributionId($distribution_id) {
        $query = $this->_bdd->prepare("SELECT * FROM Hypervisor_has_Distribution WHERE Distribution_id=? LIMIT 1");
        $query->execute([$distribution_id]);
        if ($query->rowCount()) {
            $hypervisor_distribution = $query->fetch(PDO::FETCH_ASSOC);
            $hypervisor_id = $hypervisor_distribution["Hypervisor_id"];
            $hypervisor = $this->getHypervisorBy(["id" => $hypervisor_id]);
            if ($hypervisor) {
                return $hypervisor;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getHypervisorBy($data = false) {
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
        $query = $this->_bdd->prepare("SELECT * FROM Hypervisor" . $parameters);
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

    public function getDistributionBy($data = false) {
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
        $query = $this->_bdd->prepare("SELECT * FROM Distribution" . $parameters);
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

    public function getPreseedBy($data = false) {
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
        $query = $this->_bdd->prepare("SELECT * FROM Preseed" . $parameters);
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

    public function getHypervisorDistributions($hypervisor_id) {
        $query = $this->_bdd->prepare("SELECT * FROM Hypervisor_has_Distribution WHERE Hypervisor_id=?");
        $query->execute([$hypervisor_id]);
        if ($query->rowCount()) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getDistributionPreseeds($distribution_id) {
        $query = $this->_bdd->prepare("SELECT * FROM Preseed WHERE Distribution_id=?");
        $query->execute([$distribution_id]);
        if ($query->rowCount()) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}

?>