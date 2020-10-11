<?php
/**
 * Imports/autoload needed on every entry-points/Controller
 */

require __DIR__ . "/vendor/autoload.php";
spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    include __DIR__ . "/{$class}.php";
});

use Dotenv\Dotenv;

$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->load();