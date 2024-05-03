<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController {
    public function __construct() {
        $this->model = new AppModel();
    }
}