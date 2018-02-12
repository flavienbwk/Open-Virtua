<?php

class dockerModel extends apiModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    /*
     * This function installs Docker on the master server.
     */

    public function initDocker($master, $hypervisor) {
        $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);
        $password = $this->_Page->f_decrypt($this->_Page->getConfigVar("master_password"), $master["password"]);
        $connection = $servermanagerModel->isSshValid($master["ip"], $master["ssh_port"], $master["username"], $password);
        if ($connection) {
            if (!$servermanagerModel->isPacketInstalled("docker")) {
                $command = $hypervisor["script"];
                $command_query = $servermanagerModel->command($connection, $command);
                if ($command_query) {
                    if ($servermanagerModel->isPacketInstalled("docker")) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function createDockerInstance($name, $master) {
        $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);
        $password = $this->_Page->f_decrypt($this->_Page->getConfigVar("master_password"), $master["password"]);
        $connection = $servermanagerModel->isSshValid($master["ip"], $master["ssh_port"], $master["username"], $password);
        if ($connection) {
            $name = substr(sha1($name), 0, 8);
            $dockerfile = file_get_contents($this->_Page->renderURI("Web/procedures/Dockerfile_test.txt"));
            $dockerfile .= "\nADD " . $this->_Page->renderURI("Web/procedures/Docker_sh.sh") . " /app/";

            $ports_expose = ["83"];
            $ports_line = "";
            foreach ($ports_expose as $port_expose) {
                $dockerfile .= "\nEXPOSE " . $port_expose;
                $ports_line .= "-p " . $port_expose . ":" . $port_expose;
            }

            $preseeds_line = "";
            $preseeds = [
                "apt-get install nginx -y"
            ];
            foreach ($preseeds as $preseed) {
                $preseeds_line .= "\n ADD " . $preseed;
            }

            file_put_contents($this->_Page->renderURI("Web/procedures/Docker_sh.sh"), $preseeds_line);

            // Add the content of Docker_sh.sh inside the server.
            $build_command = "sudo docker build -t " . $name . " -f " . $this->_Page->renderURI("Web/procedures/Dockerfile_test.txt");
            $run_command = "sudo docker run -d " . $ports_line . " -v " . $name;

            var_dump($servermanagerModel->command($connection, $build_command));

            var_dump($dockerfile);
            var_dump($build_command);
            var_dump($run_command);
        } else {
            return false;
        }
    }

    public function removeDockerInstance($name, $master) {
        $servermanagerModel = new servermanagerModel($this->_Page, $this->_bdd);
        $password = $this->_Page->f_decrypt($this->_Page->getConfigVar("master_password"), $master["password"]);
        $connection = $servermanagerModel->isSshValid($master["ip"], $master["ssh_port"], $master["username"], $password);
        if ($connection) {
            $command = "docker rm -v " . substr(sha1($name), 0, 8);
            $command_query = $servermanagerModel->command($connection, $command);
            if ($command_query) {
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
