<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends AppController {
    public function home($req, $res){
        echo "this is /Dashboard/home";

        $Test = $this->model->test;
        // $More = $this->model->more;
        $Well = $this->model->well;

        echo "<br>".$Test->hello("Test");
        // echo "<br>".$More->hello("More");
        echo "<br>".$Well->hello("Well");

        // // Get the amount of memory currently being used
        // $memoryUsage = memory_get_usage();

        // // Convert bytes to a human-readable format (optional)
        // $memoryUsageFormatted = $Test->formatBytes($memoryUsage);

        // // Output the memory usage
        // echo "<br>Memory Usage: $memoryUsageFormatted";

        // // Function to format bytes to a human-readable format

        // // Get the value of memory_limit directive
        // $memoryLimit = ini_get('memory_limit');

        // // Output the memory limit
        // echo "<br>Memory Limit: $memoryLimit";
        
    }

    public function about($req, $res){
        echo "this is /Dashboard/about";
    }

    public function contact($req, $res){
        echo "this is /Dashboard/contact";
    }
}