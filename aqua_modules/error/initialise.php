<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UiError {
    public function __construct($th) {
        $error = [];
    
        // Extract basic error information
        $error['type'] = get_class($th);
        $error['message'] = $th->getMessage();
        $error['file'] = $th->getFile();
        $error['line'] = $th->getLine();

        if (file_exists($error['file'])) {
            $lines = file($error['file']);
            $start = max(0, $error['line'] - 4); // 3 lines before the error line
            $end = min(count($lines), $error['line'] + 3); // 2 lines after the error line
    
            $codeSnippet = '';
            for ($i = $start; $i < $end; $i++) {
                // Highlight the error line
                if ($i == $error['line'] - 1) {
                    $codeSnippet .= '<div style="background: #ff000038; color: #d8000c; padding: 2px 4px; border-radius: 5px;">' . ($i + 1) . ': ' . htmlspecialchars($lines[$i]) . '</div>';
                } else {
                    $codeSnippet .= '<div style="padding: 2px 4px;">' . ($i + 1) . ': ' . htmlspecialchars($lines[$i]) . '</div>';
                }
            }
        } else {
            $codeSnippet = 'Unable to read the file.';
        }

        // Extract stack trace (optional, depending on your needs)
        // $error['trace'] = $th->getTrace();
    
        // Convert array to JSON (optional)
        $this->errorJson = json_encode($error);
        $this->codeSnippet = $codeSnippet;
        $this->trace = explode('Stack trace:',$th)[1];
    }

    public function display(){
        global $config;
        $page = "/errors/error/error";
        require_once BASEPATH.$config->config->view_dir.$page.".php";
    }

    public function displayError500(){
        global $config;
        $page = "/errors/500/error";
        require_once BASEPATH.$config->config->view_dir.$page.".php";
    }

}