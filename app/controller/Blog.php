<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends AppController {
    public function index($req, $res){
        echo $req->params->id;
        echo '<br>';
        echo "this is /blog";
        echo "<pre>";
        print_r($req);
        echo "</pre>";
    }
}