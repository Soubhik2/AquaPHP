<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppModel {
    public function __construct() {
        global $config;
        $directory = BASEPATH.$config->config->model_dir;
        $files = scandir($directory);

        // $dir = opendir($directory);
        // while (($file = readdir($dir)) !== false) {
        //     if ($file != "." && $file != "..") {
        //         $arr = explode('.',$file);
        //         eval('require_once $directory."'.$arr[0].'.php";');
        //         eval('$this->'.strtolower($arr[0]).' = new '.$arr[0].'();');
        //     }
        // }
        // closedir($dir);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $arr = explode('.',$file);
                eval('require_once $directory."'.$arr[0].'.php";');
                eval('$this->'.strtolower($arr[0]).' = new '.$arr[0].'();');
            }
        }
    }
}