<?php

include("Direct.class.php");

/**
 * Description of the Page class.
 * This class manage the important functions of the framework
 * related to the treatment of the page.
 * 
 */
class Page extends Direct {

    private $_page_title, $_language, $_ressources_css = [], $_ressources_js = [];

    public function __construct() {
        parent::__construct();
        $this->_page_title = $this->getConfigVar("website_title");
        $this->setTitle($this->getConfigVar("website_title"));
        $this->setLanguage("en");

        // $this->goFollowPath(); // Facultative : automatically follows the path set with $Page->setFollowPath().
    }

    public function setLanguage($language) {
        if (file_exists(dirname(__FILE__) . "/../Web/langs/" . $language . "/")) {
            $this->_language = $language;
        } else {
            $this->raiseError("Inexistant language. Not found under Web/langs/<b>$language</b>. Replaced with english (en).");
        }
    }

    public function getString($var, $file = false, $language = false) {
        /*
         * Get the text from the strings stored in Components/langs/*.
         * '*' represents the name of the file (here, the $file value).
         * 
         * If $file is not filled when calling the function,
         * the function is automatically looking a json file in
         * Components/langs/* in which "*" takes the value
         * of the name of the folder from which is called the view
         * and the name of the view file (without the View suffix).
         * Form : FolderFilename.json
         * Example : IndexIndex.json
         */
        if ($language && !empty($language)) {
            $this->setLanguage($language);
        }
        if ($file === false) {
            $backtrace = debug_backtrace();
            $backtrace = explode("/", $backtrace[0]["file"]);
            $backtrace_file = $backtrace[sizeof($backtrace) - 1];
            if (substr($backtrace_file, -8) == "View.php") {
                $backtrace_file = substr($backtrace_file, 0, -8);
            } else if (substr($backtrace_file, -14) == "Controller.php") {
                $backtrace_file = substr($backtrace_file, 0, -14);
            } else if (substr($backtrace_file, -9) == "Model.php") {
                $backtrace_file = substr($backtrace_file, 0, -9);
            } else {
                echo $this->raiseError("Impossible to get the backtrace. (" . $var . ", for " . $backtrace_file . ", " . substr($backtrace_file, -8) . ")");
                exit();
            }
            $backtrace_folder = $backtrace[sizeof($backtrace) - 2];
            $file = $backtrace_folder . "." . $backtrace_file . ".json";
        }
        $path = dirname(__FILE__) . "/../Web/langs/" . $this->_language . "/" . $file;

        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            if (isset($data[$var])) {
                return $data[$var];
            } else {
                return false;
            }
        } else {
            echo $this->raiseError("Inexistant traduction file (" . $this->_language . "/" . $file . ").");
            exit();
        }
    }

    public function setTitle($title, $overwrite = false) {
        /*
         * If $overwrite is set true, it won't overwrite the actual 
         * title and will add $title to the actual title set.
         */

        if (!empty($title)) {
            if ($overwrite) {
                $this->_page_title = $title . $this->_page_title;
            } else {
                $this->_page_title = $title;
            }
        }
    }

    public function includeFile($file_name) {
        require($this->renderURI($file_name));
    }

    public function getTitle() {
        return $this->_page_title;
    }

    public function getLanguage() {
        return $this->_language;
    }

    public function is_post(array $array) {
        foreach ($array as $arr) {
            if (!isset($_POST[$arr])) {
                return false;
            }
        }
        return true;
    }

    public function is_post_not_empty(array $array) {
        /*
         * Replace the isset() function.
         * Checks if the array variables are existing
         * in the $_POST variable.
         */
        foreach ($array as $arr) {
            if (isset($_POST[$arr]) && empty($_POST[$arr])) {
                return false;
            }
        }
        return true;
    }

    public function post_variables_init(array $array, $config = null) {
        /*
         * Automaticaly declares the POST variables as variables
         * of the same name, provided in $array.
         * If $_POST["test"] is an existing variable,
         * and $array = array("test"),
         * $test will be initialized.
         * 
         * Be careful, any variable having the same name than
         * those who are in the $array will be overwrited in your program.
         */

        if (isset($config) && !empty($config)) {
            if ($config === true) {
                foreach ($array as $name) {
                    $GLOBALS[$name] = htmlentities($_POST[$name]);
                }
            } else {
                for ($i = 0; $i < sizeof($array); $i++) {
                    if (isset($config[$i])) {
                        if (empty($config[$i])) {
                            $GLOBALS[$array[$i]] = $_POST[$array[$i]];
                        } else if (strtoupper($config[$i]) == "HTMLENTITIES" || strtoupper($config[$i]) == "HE") {
                            $GLOBALS[$array[$i]] = htmlentities($_POST[$array[$i]]);
                        } else if (strtoupper(substr($config[$i], 0, 4)) == "SHA1") {
                            if (strtoupper($config[$i]) == "SHA1") {
                                // Classic sha1 treatment.
                                $GLOBALS[$array[$i]] = sha1($_POST[$array[$i]]);
                            } else {
                                // Adding a salt.
                                $salt = substr($config[$i], 4);
                                $GLOBALS[$array[$i]] = sha1($_POST[$array[$i]] . $salt);
                            }
                        } else {
                            $GLOBALS[$array[$i]] = $_POST[$array[$i]];
                        }
                    } else {
                        $GLOBALS[$name] = $_POST[$name];
                    }
                }
            }
        } else {
            foreach ($array as $name) {
                $GLOBALS[$name] = $_POST[$name];
            }
        }
    }

    public function addRessource(array $array) {
        $array = array($array);
        for ($i = 0; $i < sizeof($array); $i++) {
            if ($array[$i][1] == "css") {
                array_push($this->_ressources_css, $array[$i][0]);
            } else if ($array[$i][1] == "js") {
                array_push($this->_ressources_js, $array[$i][0]);
            } else {
                array_push($this->_ressources_css, $array[$i][0]);
            }
        }
    }

    /**
     * $type is whether "css" or "js".
     */
    public function getRessource($type) {
        $concatenated = "";
        if ($type == "css") {
            foreach ($this->_ressources_css as $ressource) {
                $concatenated .= "<link rel=\"stylesheet\" href=\"" . $ressource . "\"/>\n";
            }
        } else if ($type == "js") {
            foreach ($this->_ressources_js as $ressource) {
                $concatenated .= "<script src=\"" . $ressource . "\"/></script>\n";
            }
        } else {
            return false;
        }
        return ($concatenated === "") ? false : $concatenated;
    }

    /**
     * Returns true or false if ressource variable is not empty for $type.
     * $type is whether "css" or "js".
     */
    public function isRessource($type) {
        if ($type == "css") {
            if (!empty($this->_ressources_css)) {
                return true;
            } else {
                return false;
            }
        } else if ($type == "js") {
            if (!empty($this->_ressources_js)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isConnectionSecure() {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    }

    function f_crypt($private_key, $str_to_crypt) {
        $private_key = md5($private_key);
        $letter = -1;
        $new_str = '';
        $strlen = strlen($str_to_crypt);

        for ($i = 0; $i < $strlen; $i++) {
            $letter++;
            if ($letter > 31) {
                $letter = 0;
            }
            $neword = ord($str_to_crypt{$i}) + ord($private_key{$letter});
            if ($neword > 255) {
                $neword -= 256;
            }
            $new_str .= chr($neword);
        }
        return base64_encode($new_str);
    }

    function f_decrypt($private_key, $str_to_decrypt) {
        $private_key = md5($private_key);
        $letter = -1;
        $new_str = '';
        $str_to_decrypt = base64_decode($str_to_decrypt);
        $strlen = strlen($str_to_decrypt);
        for ($i = 0; $i < $strlen; $i++) {
            $letter++;
            if ($letter > 31) {
                $letter = 0;
            }
            $neword = ord($str_to_decrypt{$i}) - ord($private_key{$letter});
            if ($neword < 1) {
                $neword += 256;
            }
            $new_str .= chr($neword);
        }
        return $new_str;
    }

}
