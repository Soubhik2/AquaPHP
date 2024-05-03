<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "request.php";
require_once "response.php";
require_once "router.php";

class AppRouter {
    public $app;

    public function __construct() {
        $this->app = new Routers();
        $this->model = new AppModel();
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
}

$directory = BASEPATH.$config->config->router_dir;

$files = scandir($directory);
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        $arr = explode('.',$file);
        eval('require_once $directory."'.$arr[0].'.php";');
        eval('(new '.$arr[0].'())->router();');
    }
}



