<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routers {
    private $isPage = false;
    
    public function __construct() {
        $this->req = new Request();
        $this->res = new Response();
        $this->controller = new UiController();
    }

    public function get($req, $callbacks){
        // global $request;
        // echo $request.'<br>';
        // echo "<pre>";
        // print_r($this->controller->home->home("d",'w'));
        // echo "</pre>";
        $params = [];
        if (!$this->isPage && $_SERVER["REQUEST_METHOD"] == "GET") {
            if (($this->req->params = $this->findMatchedRoute($req)) || '/404' == $req) {
                if (is_string($callbacks)) {
                    $calls = explode('/', $callbacks);
                    $className = strtolower($calls[0]);
                    $methodName = $calls[1];
                    $callbacks = [$this->controller->$className,$methodName];
                }
                $callbacks($this->req, $this->res);
                $this->isPage = true;
            }
        }
    }

    public function post($req, $callbacks){
        $params = [];
        if (!$this->isPage && $_SERVER["REQUEST_METHOD"] == "POST") {
            if (($params = $this->findMatchedRoute($req)) || '/404' == $req) {
                if (is_string($callbacks)) {
                    $calls = explode('/', $callbacks);
                    $className = strtolower($calls[0]);
                    $methodName = $calls[1];
                    $callbacks = [$this->controller->$className,$methodName];
                }
                $callbacks($this->req, $this->res);
                $this->isPage = true;
            }
        }
    }

    private function findMatchedRoute($pattern) {
        $pattern = preg_replace('/\//', '\/', $pattern);
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<\1>[^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';
        global $request;
        if (preg_match($pattern, $request, $matches)) {
            $params = [];
            foreach ($matches as $key => $value) {
                if (!is_numeric($key)) {
                    $params[$key] = $value;
                }
            }
            return (object) $params;
        }
        return false;
    }
}