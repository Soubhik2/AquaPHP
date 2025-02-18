<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once import("auth");

class Router extends AppRouter {
    public function router() {

        $this->app->get("/",function($req, $res){
            
            $res->status(200)->render('welcome',["name"=>"ram", "user"=>["name"=>"sam"]]);

        });

        $this->app->post("/",function($req, $res){
            echo "this is / - post";    
            echo "<pre>";
            print_r($req);
            echo "</pre>";
        });

        $this->app->get("/db-test",function($req, $res){
            echo "/db-test <br>";
            echo $this->db->select('users',['email'=>"soubhik@gmail.com"])->count();
        });

        $this->app->get("/b-test",function($req, $res){
            // echo '<pre>';
            // print_r($res);
            // echo '</pre>';

            $Test = $this->model->test;
            echo "<br>".$Test->hello("PUBG").'<br>';
            echo url('/home');
        });

        $this->app->get("/test",function($req, $res){   
            echo "/test <br>";
            $auth = new Auth($this->db);

            $email = "sam@gmail.com";
            $password = "sam@1234";

            // Sign Up
            // $arr =  [   // Those are extra fields
            //     "name"=>"sam gt",
            //     "phone"=>"+91 9000000000",
            // ];

            // $result = $auth->signUp($email, $password, $arr);
            
            // if(!$result->error){
            //     echo "Successfully Signed up";
            // }else{
            //     echo $result->error_mess;
            // }

            // Sign In
            // $result = $auth->signIn($email, $password);

            // if(!$result->error){
            //     echo "Successfully Signed in";
            // }else{
            //     echo $result->error_mess;
            // }

            // isLogged
            // if ($auth->isLoggedin()) {
            //     echo "YES";
            // } else {
            //     echo "NO";
            // }

            // get data
            $user = $auth->getUser();
            echo '<pre>';
            print_r($user);
            echo '</pre>';

        });

        $this->app->get("/blog/{id}",'Blog/index');

        $this->app->get("/home",'Home/home');
        $this->app->post("/home",'Home/about');
        $this->app->get("/about",'Home/about');

    }
}