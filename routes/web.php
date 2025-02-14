<?php
// CONTROLLERS HERE
require 'app/controllers/HomeController.php';
require 'app/controllers/BackDashboardController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$parsedUrl = parse_url($request);
$path = strtolower($parsedUrl['path']);
$queryParams = [];
parse_str($parsedUrl['query'] ?? '', $queryParams); // Parse query string into an associative array

// Remove trailing slash
if (substr($request, -1) === '/' && $request !== '/') {
    $request = substr($request, 0, -1);
}
// Define your views/urls here
//var_dump($path);
//exit;
switch ($path) {
    // GET FRONT VIEWS
    case '/':
        HomeController::index();
        break;
    // GET BACK VIEWS
    case '/admin':
        BackDashboardController::index();
        break;
    default:
        abort(404, 'Page was not found');
        break;
}
