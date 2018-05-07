<?php
// index.php file for creates the Slim API;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Required for composer libraries
require '../vendor/autoload.php';
// Define the web app's database.
require '../src/db.php';
// Define the REST API routes.
require '../src/routes.php';
// Run the Slim app.
$app->run();
