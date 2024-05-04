<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Runner {
    private $query;
    private $conn;
    private $context;
    public function __construct($context, $query) {
        $this->context = $context;
        $this->conn = $context->conn();
        $this->query = $query;
    }

    public function get($callbacks = null){
        $result = $this->conn->query($this->query);
        $arr = [];

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_object()) {
                if ($callbacks != null) {
                    $value = $callbacks($row);
                    $row = $value !=null || $value != "" ? $value : $row;
                }
                array_push($arr, $row);
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function count(){
        $result = $this->conn->query($this->query);
        return $result->num_rows;
    }
}