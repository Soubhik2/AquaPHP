<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController {
    public function __construct() {
        $this->model = new AppModel();
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
}