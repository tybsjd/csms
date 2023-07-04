<?php
ini_set('serialize_precision','-1');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST'); // it can have GET,PUT and other methods
header('Content-Type: application/json');

//Set custom Exception handler
include_once "Exceptions/ErrorHandler.php" ;
include_once "controllers/MeterController.php";
//include_once "models/Meter.php";
$routes = include_once ("routes.php");

//Custom error handler
set_error_handler("ErrorHandler::handle_error");
set_exception_handler("ErrorHandler::handle_exception");

// Resolve the requested route
$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/',$_SERVER['REQUEST_URI']);
$route = $routes[$method][$path[2]] ?? false;
// Check if the route exists
if (!$route) {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found']);
    exit;
}
// Load the necessary controller and execute the action
$controllerName = $route['controller'];
$action = $route['action'];
$controller = new $controllerName();
$controller->$action();
