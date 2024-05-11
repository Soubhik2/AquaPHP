<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setter {
    private $query;
    private $conn;
    private $context;
    public function __construct($context, $query) {
        $this->context = $context;
        $this->conn = $context->conn();
        $this->query = $query;
    }
    
    public function set($data, $then = null, $catch = null){
        $query = '';
        if (is_array($data)) {
            $query = $this->insert($data);
        }else{
            $query = $data;
        }
        $then($query);
        return $query;
        // try {
        //     $result = $this->conn->query($query);
        //     if ($result) {
        //         $then($this->conn);
        //         return $this->conn;
        //     }else{
        //         $then(false);
        //         return false;
        //     }
        // } catch (\Throwable $th) {
        //     $catch($th);
        //     return $th;
        // }
    }

    public function insert($data){
        $length = count($data);
        $query .= $this->query;
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
        return $query;
    }

    public function update(){
        
    }

}