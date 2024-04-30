<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends AppRouter {
    public function router() {

        // $this->app->get("/",function(){
        //     echo "this is /";    
        // });

        $this->app->get("/blog/:id",function(){
            echo "this is /blog";
        });

        // $this->app->get("/home",[$this->home,'home']);

        // // 404 page Note set this to the end
        // $this->app->get("/404",function(){
        //     echo "this is /404";
        // });

    }
}