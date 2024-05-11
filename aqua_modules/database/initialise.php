<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'runner.php';
require_once 'setter.php';

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

    public function select($table, $query = null) {
        if ($query != null) {
            if (is_array($query)) {
                $query = "SELECT * FROM `$table` ".$this->query_builder($query);
            } else {
                $query = "SELECT * FROM `$table` ".$query;
            }
            
        }else{
            $query = "SELECT * FROM `$table`";
        }
        // return $query;
        return new Runner($this, $query);
    }

    public function insert($table) {
        $query = "INSERT INTO $table (";
        return new Setter($this, $query);
    }
    public function update($table, $data) {
        $query = "UPDATE $table SET ";
        return new Setter($this, $query);
    }

    public function query($query){
        return new Runner($this, $query);
    }

    public function conn(){
        // echo 'hello';
        return $this->conn;
    }

    private function query_builder($arr){
        $query = 'WHERE ';
        $i = 0;
        foreach ($arr as $key => $value) {
            $sub = "";
            $type = "AND";

            $key_arr = explode(' ',$key);

            if (strpos(strtoupper($key), "OR") !== false) {
                array_shift($key_arr);
                $type = "OR";
            }
            if (strpos(strtoupper($key), "AND") !== false) {
                array_shift($key_arr);
                $type = "AND";
            }

            if ($i <= 0) {
                if (count($key_arr) > 1) {
                    $sub = "`".$key_arr[0]."` ".strtoupper($key_arr[1])." '".$value."'";
                }else{
                    $sub = "`".$key_arr[0]."` = '".$value."'";
                }
            } else {
                if (count($key_arr) > 1) {
                    $sub = " $type `".$key_arr[0]."` ".strtoupper($key_arr[1])." '".$value."'";
                }else{
                    $sub = " $type `".$key_arr[0]."` = '".$value."'";
                }
            }
            
            $query .= $sub;
            $i++;
        }
        return $query;
    }
}