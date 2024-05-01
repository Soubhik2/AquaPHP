<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController {
    public function __construct() {
        global $config;
        $directory = BASEPATH.$config->config->controller_dir;
        $files = scandir($directory);

        $dir = opendir($directory);
        while (($file = readdir($dir)) !== false) {
            if ($file != "." && $file != "..") {
                print_r($file);
            }
        }
        closedir($dir);

    }
}