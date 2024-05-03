<?php

// config
define("sitename", "Water Socials");
define("baseurl", "/www/wwwroot/watersocials.fun");

spl_autoload_register(function ($class_name) {
    $directory = baseurl . '/private/classes/';
    $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
    $file = $directory . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
        //echo "<br>" . $file . " aquired";
    }
    else {
        //echo "<br>" . $file . " could not be found";
    }
});

set_error_handler(function ($severity, $message, $file, $line) {
    //$hello = new logging();
    //->errorwebhook("Including file: $file");
    throw new \ErrorException($message, $severity, $severity, $file, $line);
});