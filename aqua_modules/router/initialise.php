<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "interface.php";
require_once "router.php";

class AppRouter {
    public $app;

    public function __construct() {
        $this->app = new Routers();

        global $config;
        $directory = BASEPATH.$config->config->controller_dir;
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $arr = explode('.',$file);
                eval('require_once $directory."'.$arr[0].'.php";');
                eval('$this->'.strtolower($arr[0]).' = new '.$arr[0].'();');
            }
        }
    }
}

$directory = BASEPATH.$config->config->router_dir;

$files = scandir($directory);
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        $arr = explode('.',$file);
        eval('require_once $directory."'.$arr[0].'.php";');
        eval('(new '.$arr[0].'())->router();');
    }
}



