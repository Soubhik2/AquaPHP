<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once import("auth");

class Router extends AppRouter {
    public function router() {

        $this->app->get("/",function($req, $res){
            // echo "this is /";   
            echo "<pre>";
            // SELECT
            // print_r($this->db->select("student", "WHERE `name` = 'soubhik1'")->get());
            // print_r($this->db->select("student")->get());
            // print_r($this->db->select("student", null, ["name"])->get());
            // print_r($this->db->select("student", ["id"=>"name", "or name"=>"game", "price >"=>"1000"]));
            // print_r($this->db->select("student", ["name like"=>"%sou%"])->get(function($value){
            //     $value->name .= " set";
            //     // $value->add = $this->db->select("contact", ["id"=>$value->id])->get();
            //     $arr = $this->db->select("contact", ["id"=>$value->id])->get()[0];

            //     foreach ($arr as $key => $element) {
            //         $value->$key = $element;
            //     }

            //     return $value;
            // }));
            // echo $this->db->select('student')->count();
            // print_r($this->db->select("student", ["name like"=>"%sou%"])->get(fn($v)=>(array)$v));
            // print_r($this->db->select("student", ["name like"=>"%sou%"])->get(fn($v)=>json_encode($v)));

            // INSERT
            // $this->db->insert('student',["name"=>"test2", "city"=>"game"])->then(function($v){
            //     print_r("DONE");
            // })->catch(function($e){
            //     print_r("ERROR");
            // });

            // print_r($this->db->insert('student',["name1"=>"test2", "city"=>"game"]));

            // UPDATE
            // print_r($this->db->update('student', ["id"=>'31'], ["name"=>"test3", "city"=>"game"]));
            // $this->db->update('student', ["id"=>'31'], ["name"=>"test3", "city"=>"game"])->then(function($v){
            //     echo "DONE";
            // })->catch(function($e){
            //     echo "ERROR";
            // });

            // DELETE
            // print_r($this->db->delete('student', ["id"=>'31']));
            // $this->db->delete('student', ["id"=>'32'])->then(function($v){
            //     echo "DONE";
            // })->catch(function($e){
            //     echo "ERROR";
            // });
            
            echo "</pre>";

            // $this->db->select("student", ["name like"=>"%sou%"])->get(function($value){
            //     echo "<h1>$value->name</h1>";
            // });

            // $Test = $this->model->test;
            // echo "<br>".$Test->hello("PUBG");

            // RES
            // $res->status(200)->send('welcome');
            // $res->status(200)->json(["name"=>"game", "user"=>"hi"]);
            // $res->status(200)->json($this->db->select("student", ["name like"=>"%sou%"])->get());

            // $res->cookie('pass','hello');
            // $res->session("login",["user"=>"name", "pass"=>"pass"]);


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
            echo "<br>".$Test->hello("PUBG");

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