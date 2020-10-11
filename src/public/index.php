<?php
/**
 * Front Controller
 */

use Controllers\DeviceController;

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (0 === error_reporting()) { // error was suppressed with the @-operator
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
    require("../bootstrap.php");

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: OPTIONS,GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $method = $_SERVER["REQUEST_METHOD"];

    if ($method === "OPTIONS") {
        header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
        exit();
    }

    $uri = $_SERVER["REQUEST_URI"];
    $body = file_get_contents('php://input'); //https://stackoverflow.com/questions/8945879/how-to-get-body-of-a-post-in-php
    $controller = null;

    if (preg_match("/\/api\/device\/.*/", $uri)) {
        $controller = new DeviceController($_ENV["CSV_FILE_PATH"], $method, $uri, $body);
    }

    if (is_null($controller)) {
        header("HTTP/1.1 404 Not Found");
        exit();
    }

    $controller->processRequest();

} catch (Throwable $t) { // Handles everything that is not already handled
    error_log($t, 0); // Send the error to Apache's error.log
    header("HTTP/1.1 500 Internal Server Error"); // Obfuscate the error from the WWW
}