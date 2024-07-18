<?php
ob_start();
// require_once __DIR__.'/aqua_modules/error/handler.php';
define("BASEPATH", __DIR__);
$pass_url = 'AquaPHP';
$localhost = $_SERVER["SERVER_NAME"];
define("BASEURL", "http://$localhost/$pass_url/");
$request = $_SERVER['REQUEST_URI'];

// Specify the file path
$load_config = "config.json";
$load_config_lock = "config-lock.json";
$config = [];
$config_lock = [];

// Check if the file exists
if (file_exists($load_config)) {
    $config = json_decode(file_get_contents($load_config));
} else {
    // If the file doesn't exist, display an error message
    echo "File not found!";
}

if (file_exists($load_config_lock)) {
    $config_lock = json_decode(file_get_contents($load_config_lock));
} else {
    // If the file doesn't exist, display an error message
    echo "File not found!";
}

// echo "<pre>";
// print_r($config);
// print_r($config_lock);
// echo "</pre>";

function url($url){
    $url = BASEURL.$url;
    $url = str_replace("//","/",$url);
    $url = str_replace(":/","://",$url);
    return $url;
}

function import_modules($path){
    // return BASEPATH.$config_lock->packages->core->path;
    global $config_lock;
    try {
        eval('$r = BASEPATH.$config_lock->packages->'.$path.'->path;');
        return $r;
    } catch (\Throwable $th) {
        return 'error';
    }
}

function import($path){
    // return BASEPATH.$config_lock->packages->core->path;
    global $config;
    global $config_lock;
    try {
        eval('$path_name = $config->dependencies->'.$path.'->path;');
        eval('$r = BASEPATH.$config_lock->packages->'.$path_name.'->path;');
        return $r;
    } catch (\Throwable $th) {
        return $th;
    }
}

try {
    require_once import_modules("core");
} catch (\Throwable $th) {
    require_once import_modules("error");
    $error = new UiError($th);

    if ($config->config->project == "development") {
        // echo '<pre>';
        // echo '<h2>'.$th.'</h2>';
        // echo '</pre>';
        ob_end_clean();
        $error->display();
    }

    if ($config->config->project == "deploy") {
        ob_end_clean();
        $error->displayError500();
        // echo "<h1>500</h1>";
    }
}