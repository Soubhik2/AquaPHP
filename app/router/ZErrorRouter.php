<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ZErrorRouter extends AppRouter {
    public function router() {
        $this->app->get("/404",function($req, $res){
            $res->status(404)->render('errors/404/error');
        });
    }
}