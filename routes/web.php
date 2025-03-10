<?php
// CONTROLLERS HERE
require 'app/controllers/HomeController.php';
require 'app/controllers/BackDashboardController.php';
require 'app/controllers/BuscarController.php';
require 'app/controllers/RegistrarController.php';
require 'app/controllers/CarritoController.php';
require 'app/controllers/DevolucionController.php';
require 'app/controllers/PoliticaController.php';
require 'app/controllers/MetodoDePagoController.php';
require 'app/controllers/ContactoController.php';

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
    case '/buscar':
        BuscarController::index();
        break;
    case '/registrar':
        RegistrarController::index();
        break;
    case '/carrito':
        CarritoController::index();
        break;
    case '/devolucion':
        DevolucionController::index();
        break;
    case '/politica':
        PoliticaController::index();
        break;
    case '/metododepago':
        MetodoDePagoController::index();
        break;
    case '/contacto':
        ContactoController::index();
        break;
    // GET BACK VIEWS
    case '/admin':
        BackDashboardController::index();
        break;
    default:
        abort(404, 'Page was not found');
        break;
}
