<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response{
    private $status;
    
    public function __construct() {
        $this->status = 200;
    }

    public function status($code){
        $this->status = $code;
        return $this;
    }

    public function redirect($page, $url = true){
        if ($url) {
            header("Location: ".BASEURL.$page);
        }else{
            header("Location: $page");
        }
        exit();
    }

    public function send($page){
        global $config;
        http_response_code($this->status);
        require_once BASEPATH.$config->config->view_dir.$page.".php";
        exit();
    }

    public function json($json){
        http_response_code($this->status);
        echo json_encode($json);
        exit();
    }

    public function render($page, $json = null){
        global $config;
        http_response_code($this->status);
        if ($json != null) {
            foreach ($json as $key => $value) {
                if (is_numeric($value)) {
                    eval ('$'.$key.' = '.$value.';');
                } else if (is_array($value)) {
                    eval ('$'.$key.' = \''.json_encode($value).'\';');
                    eval ('$'.$key.' = json_decode($'.$key.');');
                } else {
                    eval ('$'.$key.' = "'.$value.'";');
                }
                
            }
        }
        require_once BASEPATH.$config->config->view_dir.$page.".php";
        exit();
    }

    public function cookie($name, $value, $expires=86400, $path="/", $domain="", $secure=false, $httponly=false){
        setcookie($name, $value, time() + ($expires), $path, $domain, $secure, $httponly);
    }

    public function session($name, $value=""){
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $_SESSION[$key] = $value;
            }
        } else {
            $_SESSION[$name] = $value;
        }
        
    }
}