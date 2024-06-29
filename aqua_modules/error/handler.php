<?php
function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    // Create an error array with details
    $error = [
        'type' => 'Error',
        'message' => $errstr,
        'file' => $errfile,
        'line' => $errline
    ];

    // Read the file and get a few lines of code around the error line
    if (file_exists($errfile)) {
        $lines = file($errfile);
        $start = max(0, $errline - 3); // 2 lines before the error line
        $end = min(count($lines), $errline + 2); // 2 lines after the error line

        $codeSnippet = '';
        for ($i = $start; $i < $end; $i++) {
            // Highlight the error line
            if ($i == $errline - 1) {
                $codeSnippet .= '<span style="background: #ffbaba; color: #d8000c;">' . ($i + 1) . ': ' . htmlspecialchars($lines[$i]) . '</span>';
            } else {
                $codeSnippet .= ($i + 1) . ': ' . htmlspecialchars($lines[$i]);
            }
        }
    } else {
        $codeSnippet = 'Unable to read the file.';
    }

    // Display the error in a formatted way similar to the provided screenshot
    echo '<pre style="background: #282c34; color: #abb2bf; padding: 1em; border-radius: 5px; white-space: pre-wrap;">';
    echo '<code>';
    echo '<strong>' . htmlspecialchars($error['file']) . ' (' . $error['line'] . ')</strong><br><br>';
    echo htmlspecialchars($error['type']) . ': ' . htmlspecialchars($error['message']) . '<br>';
    echo '<br>Code Reference:<br>' . $codeSnippet;
    echo '</code>';
    echo '</pre>';

    // Prevent default PHP error handler
    return true;
}

// Set the custom error handler
set_error_handler('customErrorHandler');

// Example code to trigger an error
// echo $undefinedVariable; // This will trigger a notice
