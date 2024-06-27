<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ZErrorRouter extends AppRouter {
    public function router() {
        // 404 page Note set this to the end
        $this->app->get("/404",function($req, $res){
            $res->status(200)->render('errors/404/error');
        });
    }
}