<?php

namespace watrlabs\pages;

class builder {

    public $TABNAME;

    public function __construct() {
        return "Hello World!";
        // nothing is needed here + I need to do more research on this
    }

    public function set_tabname($newtabname){
        $TABNAME = $newtabname;
    }

    public function get_tabname() {
        return $TABNAME;
    }
    
    public function replaceholder($content) {
        str_replace('TABNAME', $TABNAME, $content);
    }

    public function loadtemplate($page){
        try { 
            // ty https://stackoverflow.com/questions/18487709/replace-string-from-php-include-file
            include_once("templates/$page.php");
        } catch (\ErrorException $e){
            //$hello = new logging();
            //$hello->errorwebhook($e);
            die("An error occured inside the webpage, it may be broken or parts may be missing. $e");
        }
    }
}
