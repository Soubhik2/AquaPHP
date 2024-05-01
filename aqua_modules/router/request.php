<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request{
    public function __construct() {
        session_start();
        $this->params = (object) [];
        $this->query = $this->Query();
        $this->body = $this->Body();
        $this->cookie = $this->Cookie();
        $this->session = $this->Session();
    }

    private function Query(){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        return (object) $_GET;
    }

    private function Body(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        return (object) $_POST;
    }

    private function Cookie(){
        $_COOKIE = filter_input_array(INPUT_COOKIE, FILTER_SANITIZE_STRING);
        return (object) $_COOKIE;
    }

    public function Session(){
        return (object) $_SESSION;
    }
}