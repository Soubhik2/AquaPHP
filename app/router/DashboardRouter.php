<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardRouter extends AppRouter {
    public function router() {
        $this->app->get("/dashboard/home",'Dashboard/home');
        $this->app->get("/dashboard/about",'Dashboard/about');
        $this->app->get("/dashboard/contact",'Dashboard/contact');
    }
}