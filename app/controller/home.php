<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home {
    public function home($req, $res){
        echo "this is /home";
        echo "<pre>";
        print_r($req);
        echo "</pre>";
    }
}