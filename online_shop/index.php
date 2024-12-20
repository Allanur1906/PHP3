<?php
require_once "config/routes.php";
require_once "config/pdo.php"; 
require_once "app/helpers/requests.php";


// Start the session (optional, if using sessions)
session_start();

$post = Requests::post();
$get = Requests::get();
$request = Requests::request();



// Initialize the router and route the request
$router = new Router();
$router->direct();


