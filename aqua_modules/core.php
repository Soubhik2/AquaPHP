<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$request = str_replace("/$pass_url",'',$request);
$requests = explode('/', $request);

if ($config->config->project == "development") {
    error_reporting(E_ERROR | E_PARSE);
}

if ($config->config->project == "deploy") {
    error_reporting(0);
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 'Off');
}

require_once import_modules("router");