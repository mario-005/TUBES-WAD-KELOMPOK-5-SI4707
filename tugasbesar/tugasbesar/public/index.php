<?php

use Illuminate\Http\Request;

// This defines the start time of the application, used for performance monitoring
define('LARAVEL_START', microtime(true));

// Check if the application is in maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance; // If the app is in maintenance mode, show the maintenance page
}

// Register the Composer autoloader, which loads all the necessary PHP classes
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the Laravel application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Handle the incoming HTTP request and send the response
$request = Request::capture(); // Capture the current HTTP request
$app->handle($request)->send(); // Process the request and send the response

