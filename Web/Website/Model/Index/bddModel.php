<?php

class bddModel {

    private $bdd = 'dbname=';
    private $port = 'port=';
    private $serveur = 'mysql:host=';
    private $user = '';
    private $mdp = '';
    public $database;
    private $_Page;

    public function __construct($Page) {
        $this->_Page = $Page;
        $this->bdd .= $this->_Page->getConfigVar("db_name");
        $this->port .= $this->_Page->getConfigVar("db_port");
        $this->serveur .= $this->_Page->getConfigVar("db_host");
        $this->user .= $this->_Page->getConfigVar("db_username");
        $this->mdp .= $this->_Page->getConfigVar("db_password");
        try {
            $string_connection = $this->serveur . ';' . $this->port . ';' . $this->bdd;
            $this->database = new PDO($string_connection, $this->user, $this->mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->database->query("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo "<p class=\"error\"><b>Connexion impossible</b><p>Veuillez nous excuser pour le désagrément. Nos équipes sont sur le coup, veuillez revenir plus tard.</p></p> (" . $e->getMessage() . ")<br/>";
            die();
        }
    }

}
