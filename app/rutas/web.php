<?php

use rutas\Controladores\HomeController;

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$parsedUrl = parse_url($request);
$path = strtolower($parsedUrl['path']);

require_once __DIR__ . '/Controladores/HomeController.php';

switch ($path) {

    // GET FRONT VIEWS
    case '/':
        HomeController::index();
        break;

    default:
        abort(404, 'Page was not found');
        break;
}
