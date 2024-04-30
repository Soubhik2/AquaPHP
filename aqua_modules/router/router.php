<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routers implements Routes {
    private $isPage = false;
    
    public function get($req, $callbacks){
        global $request;
        // $key = str_replace("/:any",'\/[a-z]/i',$key);
        // $key = str_replace("/:num",'\/[0-9]/i',$key);

        $arr_req = explode('/',$req);
        
        $arr_req = array_map(function($value){
            if (stripos($value, ':') !== false) {
                return '\/[a-z]/i';
            } else {
                return $value;
            }
        }, $arr_req);

        echo '<pre>';
        print_r($arr_req);
        echo '</pre>';

        $req = implode("/", $arr_req);
        $req = str_replace('/\\', '\\',$req);

        echo $req.'<br>';

        if (!$this->isPage) {
            if ($request == $req || preg_match($req, $request) || '/404' == $req) {
        
                // for ($i=1; $i < count($pages); $i++) { 
                //     // echo $pages[$i].'='.$requests[$i+1].'<br>';
                //     $req_values = explode("?", $requests[$i+1]);
                //     eval('$'.$pages[$i].'="'.$req_values[0].'";');
                // }
        
                // require_once BASEPATH . $viewDir . $pages[0].'.php';
                // $isPage = TRUE;
                
                $callbacks();
                $this->isPage = true;
            }
        }

    }

    public function post($req, $callbacks){
        $callbacks();
    }
}