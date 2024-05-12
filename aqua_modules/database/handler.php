<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handler {
    private $isSuccess;
    public $error;
    public $value;
    public function __construct($isSuccess, $value, $error) {
        $this->isSuccess = $isSuccess;
        $this->value = $value;
        $this->error = $error;
    }
    
    public function then($callbacks){
        if ($this->isSuccess) {
            $callbacks($this->value);
        }
        return $this;
    }

    public function catch($callbacks){
        if (!$this->isSuccess) {
            $callbacks($this->error);
        }
        return $this;
    }

}