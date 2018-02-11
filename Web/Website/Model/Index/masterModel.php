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

    // Get the total memory from the master server.
    public function updateMemory($master_id) {
        $master = $this->getMasterBy(["id" => $master_id]);
        if ($master) {
            $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);
            $password = $this->_Page->f_decrypt($this->_Page->getConfigVar("master_password"), $master["password"]);
            $ssh_valid = $servermanagerModel->isSshValid($master["ip"], $master["ssh_port"], $master["username"], $password);
            if ($ssh_valid) {
                $connection = ssh2_connect($master["ip"], $master["ssh_port"]);
                ssh2_auth_password($connection, $master["username"], $password);

                $stream = ssh2_exec($connection, 'cat /proc/meminfo | grep MemTotal');
                stream_set_blocking($stream, true);
                $stream_out = stream_get_contents($stream);
                if (!empty($stream_out)) {
                    preg_match_all("#([0-9]{1,})#", trim($stream_out), $output);
                    if (isset($output[0][0]) && is_numeric($output[0][0])) {
                        $memory = floor(intval($output[0][0]) / 1000);
                        if ($this->update("Master", [
                                    "memory" => $memory
                                        ], [
                                    "id" => $master_id
                                ])) {
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
        } else {
            return false;
        }
    }

    // Get the available storage from the master server.
    public function updateStorage($master_id) {
        $master = $this->getMasterBy(["id" => $master_id]);

        if ($master) {
            $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);
            $password = $this->_Page->f_decrypt($this->_Page->getConfigVar("master_password"), $master["password"]);
            $ssh_valid = $servermanagerModel->isSshValid($master["ip"], $master["ssh_port"], $master["username"], $password);
            if ($ssh_valid) {
                $connection = ssh2_connect($master["ip"], $master["ssh_port"]);
                ssh2_auth_password($connection, $master["username"], $password);

                $stream = ssh2_exec($connection, 'echo $(($(stat -f --format="%a*%S" .)))');
                stream_set_blocking($stream, true);
                $stream_out = trim(stream_get_contents($stream));
                if (!empty($stream_out)) {
                    if (is_numeric($stream_out)) {
                        $storage = floor(intval($stream_out) / 1000000);
                        if ($this->update("Master", [
                                    "storage" => $storage
                                        ], [
                                    "id" => $master_id
                                ])) {
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
        } else {
            return false;
        }
    }

    public function update($table, $array, $where) {
        $where_sql = "";
        if (!empty($where)) {
            $count = 0;
            foreach ($where as $name => $val) {
                if ($count == 0) {
                    $where_sql .= " WHERE " . $name . "='" . $val . "'";
                } else {
                    $where_sql .= " AND " . $name . "='" . $val . "'";
                }
                $count++;
            }
        }

        $i = 0;
        $parameters = "";
        $array_keys = array_keys($array);

        while ($i < sizeof($array)) {
            $name = $array_keys[$i];
            $parameters .= ($i == sizeof($array) - 1) ? $name . "=" . ":" . $name : $name . "=" . ":" . $name . ",";
            $i++;
        }

        $query = $this->_bdd->prepare("UPDATE $table SET " . $parameters . $where_sql);
        $query->execute($array);
        return $query;
    }

    public function remove($master_id, $user_id) {
        $query = $this->_bdd->prepare("DELETE FROM Master WHERE id=? AND User_id=?");
        $query->execute([$master_id, $user_id]);
        return $query->rowCount();
    }

    public function removeSlaves($master_id) {
        $query = $this->_bdd->prepare("DELETE FROM Slave WHERE Master_id=?");
        $query->execute([$master_id]);
        return $query->rowCount();
    }

}
?>