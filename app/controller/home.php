<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AppController {
    public function home($req, $res){
        echo "this is /home";
        // echo "<pre>";
        // print_r($req);
        // echo "</pre>";
    }

    public function about($req, $res){
        echo "this is /about";
        // echo "<pre>";
        // print_r($req);
        // echo "</pre>";
    }
}