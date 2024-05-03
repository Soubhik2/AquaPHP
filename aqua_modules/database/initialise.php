<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database{
    private $conn;
    private $subQuery = "";
    private $error;

    public function __construct() {
        global $config;
        $this->host = $config->config->database->host;
        $this->username = $config->config->database->username;
        $this->password = $config->config->database->password;
        $this->database = $config->config->database->database;
    }

    public function connect() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        } catch (Exception $e) {
            $this->conn = false;
            $this->error = $e;
        }
        return $this->conn;
    }
}