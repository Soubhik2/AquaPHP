<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends AppRouter {
    public function router() {

        $this->app->get("/",function($req, $res){
            
            $res->status(200)->render('welcome',["name"=>"ram", "user"=>["name"=>"sam"]]);

        });

        $this->app->post("/",function($req, $res){
            echo "this is / - post";
        });

    }
}