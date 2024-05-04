<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends AppRouter {
    public function router() {

        $this->app->get("/",function($req, $res){
            // echo "this is /";   
            echo "<pre>";
            // print_r($this->db->select("student", "WHERE `name` = 'soubhik1'")->get());
            // print_r($this->db->select("student")->get());
            // print_r($this->db->select("student", ["id"=>"name", "or name"=>"game", "price >"=>"1000"]));
            print_r($this->db->select("student", ["name like"=>"%sou%"])->get(function($value){
                $value->name .= " set";
                // $value->add = $this->db->select("contact", ["id"=>$value->id])->get();
                $arr = $this->db->select("contact", ["id"=>$value->id])->get()[0];

                foreach ($arr as $key => $element) {
                    $value->$key = $element;
                }

                return $value;
            }));
            // print_r($this->db->select("student", ["name like"=>"%sou%"])->get(fn($v)=>(array)$v));
            // print_r($this->db->select("student", ["name like"=>"%sou%"])->get(fn($v)=>json_encode($v)));
            echo "</pre>";

            // $this->db->select("student", ["name like"=>"%sou%"])->get(function($value){
            //     echo "<h1>$value->name</h1>";
            // });

            // $Test = $this->model->test;
            // echo "<br>".$Test->hello("PUBG");

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

        $this->app->get("/blog/{id}",'Blog/index');

        $this->app->get("/home",'Home/home');
        $this->app->post("/home",'Home/about');

        // 404 page Note set this to the end
        $this->app->get("/404",function($req, $res){
            echo "this is /404";
        });

    }
}