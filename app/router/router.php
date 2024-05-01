<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends AppRouter {
    public function router() {

        $this->app->get("/",function($req, $res){
            echo "this is /";    
            echo "<pre>";
            print_r($req);
            echo "</pre>";

            require_once BASEPATH."/app/views/welcome.php";

        });

        $this->app->post("/",function($req, $res){
            echo "this is / - post";    
            echo "<pre>";
            print_r($req);
            echo "</pre>";
        });

        $this->app->get("/blog/{id}",function($req, $res){
            echo "this is /blog";
            echo "<pre>";
            print_r($req);
            echo "</pre>";
        });

        $this->app->get("/home",[$this->home,'home']);

        // 404 page Note set this to the end
        $this->app->get("/404",function($req, $res){
            echo "this is /404";
        });

    }
}