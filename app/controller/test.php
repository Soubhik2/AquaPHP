<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends AppController {
    public function index($req, $res){
        echo "this is /about";
    }
    public function about($req, $res){
        echo "this is /about";
    }
}