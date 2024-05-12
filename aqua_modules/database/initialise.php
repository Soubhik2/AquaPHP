<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'runner.php';
require_once 'handler.php';

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

    public function select($table, $query = null, $arr = null) {
        $sub = "";
        if ($arr != null) {
            $sub_arr = array_map(function($v){
                return "`$v`";
            }, $arr);
            $sub = implode(",",$sub_arr);
        }else{
            $sub = "*";
        }

        if ($query != null) {
            if (is_array($query)) {
                $query = "SELECT $sub FROM `$table` ".$this->query_builder($query);
            } else {
                $query = "SELECT $sub FROM `$table` ".$query;
            }
            
        }else{
            $query = "SELECT $sub FROM `$table`";
        }
        
        return new Runner($this, $query);
    }

    // public function insert($table) {
    //     $query = "INSERT INTO $table (";
    //     return new Setter($this, $query);
    // }
    // public function update($table, $data) {
    //     $query = "UPDATE $table SET ";
    //     return new Setter($this, $query);
    // }

    public function insert($table, $data) {
        $length = count($data);
        $query = "INSERT INTO $table (";
        // $query = "INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')";
        $i = 1;
        foreach ($data as $key => $value) {
            if ($length > $i) {
                $query .= "$key, ";
            } else {
                $query .= "$key";
            }
            $i++;
        }
        $query .= ") VALUES (";
        $j = 1;
        foreach ($data as $key => $value) {
            if ($length > $j) {
                $query .= "'$value', ";
            } else {
                $query .= "'$value'";
            }
            $j++;
        }
        $query .= ")";
        try {
            $result = $this->conn->query($query);
            if ($result) {
                return new Handler(true, $result, 0);
            }else{
                return new Handler(false, $result, $result);
            }
        } catch (\Throwable $th) {
            return new Handler(false, false, $th);
        }
    }

    public function update($table, $query, $data) {
        $length = count($data);
        $subQuery = "";
        if ($query != null) {
            if (is_array($query)) {
                $subQuery = $this->query_builder($query);
            } else {
                $subQuery = $query;
            }
            
        }else{
            $subQuery = "WHERE `id` = null";
        }

        $query = "UPDATE $table SET ";

        $query .= implode(', ', array_map(
            function ($k, $v) { return "$k = '$v'"; },
            array_keys($data),
            $data
        ));
        $query .= ' '; // `student`.`id`
        $query .= $subQuery;

        // return $query;
        try {
            $result = $this->conn->query($query);
            if ($result) {
                return new Handler(true, $result, 0);
            }else{
                return new Handler(false, $result, $result);
            }
        } catch (\Throwable $th) {
            return new Handler(false, false, $th);
        }
    }

    public function delete($table, $query) {
        $subQuery = "";
        if ($query != null) {
            if (is_array($query)) {
                $subQuery = $this->query_builder($query);
            } else {
                $subQuery = $query;
            }
            
        }else{
            $subQuery = "WHERE `id` = null";
        }

        $query = "DELETE FROM $table ".$subQuery;
        // return $query;
        try {
            $result = $this->conn->query($query);
            if ($result) {
                return new Handler(true, $result, 0);
            }else{
                return new Handler(false, $result, $result);
            }
        } catch (\Throwable $th) {
            return new Handler(false, false, $th);
        }
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