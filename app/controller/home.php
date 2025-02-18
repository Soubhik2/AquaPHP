<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AppController {
    public function index($req, $res){
        echo "this is /home";
    }
    public function about($req, $res){
        echo "this is /about";
    }
}