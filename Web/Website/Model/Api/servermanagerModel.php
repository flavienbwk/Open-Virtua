<?php

class servermanagerModel extends apiModel {

    var $_bdd, $_Page;

    public function __construct($Page, $bdd) {
        $this->_bdd = $bdd;
        $this->_Page = $Page;
    }

    public function isPacketInstalled($packet_name) {
        $exist = true;
        exec("apt-cache show \"" . $packet_name . "\"", $output);
        foreach ($output as $line) {
            if (preg_match("#Unable to locate package#", $line)) {
                $exist = false;
                break;
            }
        }
        return $exist;
    }

    public function isUp($host) {
        //initialize curl
        $curlInit = curl_init($host);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        //get answer
        $response = curl_exec($curlInit);

        curl_close($curlInit);

        if ($response)
            return true;

        return false;
    }

    public function isSshValid($ip, $port, $username, $password) {
        if ($this->isUp($ip)) {
            $connection = @ssh2_connect($ip, $port);
            if (@ssh2_auth_password($connection, $username, $password)) {
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