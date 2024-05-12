<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AppController {
    public function home($req, $res){
        echo "this is /home";
        // echo "<pre>";
        // print_r($req);
        // echo "</pre>";

        echo "<pre>";
        print_r($this->db);
        print_r($this->conn);
        echo "</pre>";

        $Test = $this->model->test;
        echo "<br>".$Test->hello("PUBG");
    }

    public function about($req, $res){
        echo "this is /about";
        
        // $res->redirect("home");
        // $res->redirect("https://chatgpt.com/", false);

        // echo "<pre>";
        // print_r($req);
        // echo "</pre>";
    }
}