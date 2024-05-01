<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UiController {
    public function __construct() {
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

require_once 'controller.php';