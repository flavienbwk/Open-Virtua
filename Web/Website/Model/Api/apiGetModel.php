<?php

class apiGetModel extends apiModel {

    var $_bdd, $_Page;
    private $_requests = [];
    private $_parameters = null;
    private $_checkname = null;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function checkRequest($parameters = null) {
        $this->_parameters = $parameters;

        if (!isset($_GET["parameters"]) || $parameters == null) {
            $this->_checkname = "getApiTest";
            return true;
        } else if ($this->is_in(["random_name"], $parameters)) {
            $this->_checkname = "getRandomName";
            return true;
        } else {
            return false;
        }
    }

    public function execute() {
        $method = $this->_checkname;
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            return $this->formatReturn(true, "Inexistant function. Please contact the support.");
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

    private function getRandomName() {
        $names = [
            "fred",
            "jack",
            "pierre",
            "feuille",
            "ciseaux",
            "jeanne",
            "robin",
            "samir",
            "batounette",
            "papatte",
            "jeremie",
            "tux"
        ];

        $name = $names[rand(0, sizeof($names))];
        return $this->formatReturn(true, $name, ["name" => $name]);
    }

    public function getApiTest() {
        return $this->formatReturn(true, "Everything is working !");
    }

}
