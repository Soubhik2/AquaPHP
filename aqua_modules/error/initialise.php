<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UiError {
    public function __construct($th) {
        $error = [];
    
        // Extract basic error information
        $error['type'] = get_class($th);
        $error['message'] = $th->getMessage();
        $error['file'] = $th->getFile();
        $error['line'] = $th->getLine();
    
        // Extract stack trace (optional, depending on your needs)
        // $error['trace'] = $th->getTrace();
    
        // Convert array to JSON (optional)
        $this->errorJson = json_encode($error);
        $this->trace = explode('Stack trace:',$th)[1];
    }

    public function display(){
        global $config;
        $page = "/errors/error/error";
        require_once BASEPATH.$config->config->view_dir.$page.".php";
    }

    public function displayError500(){
        global $config;
        $page = "/errors/500/error";
        require_once BASEPATH.$config->config->view_dir.$page.".php";
    }

}