<?php
defined('BASEPATH') OR exit('No direct script access allowed');

interface Routes{
    public function get($req, $callbacks);
    public function post($req, $callbacks);
}