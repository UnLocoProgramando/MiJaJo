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
    case '/registrar/user':
        // Obtener los valores del formulario para enviarlo al controlador
        if($method === 'POST'){
            $email = $_POST['email'] ?? '';
            $existe = false;
            $esUser = "user";
            try {
                if (UserModel::existeEnLaDB(['email' => $email])) {
                    $existe = true;
                    $usuario = UserModel::buscarEnLaDB($email, 'email');
                    $esUser = $usuario->tipo;
                }
            } catch (ModelNotFoundException $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
        header("Location: /");
        RegistrarController::registrarUsuario($email, $existe, $esUser);
        break;
    case '/registrar/cerrarsesion':
        session_start(); // Iniciar sesión
        session_unset(); // Eliminar todas las variables de sesión
        session_destroy(); // Destruir la sesión completamente
        header("Location: /");
        exit; // Asegurar que el script se detenga aquí
    case '/carrito':
        CarritoController::index();
        break;
    case '/carrito/agregar':
        $id = $_POST['id'] ?? null;
        CarritoController::agregarProducto($id);
        break;
    case '/carrito/actualizar':
        $id = $_GET['id'];
        $accion = $_GET['accion'];
        CarritoController::actualizar($id, $accion);
        break;
    case '/carrito/eliminar':
        $id = $_GET['id'];
        CarritoController::eliminar($id);
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
    case '/admin/formulariocoleccion':
        BackDashboardController::renderizarFormularioCollecion();
        break;
    case '/admin/agregrarcoleccion':
        // Obtener los valores del formulario para enviarlo al controlador
        if($method === 'POST') {
            $collection_name = $_POST['collection_name'] ?? '';
            BackDashboardController::agregarColeccion($collection_name);
        }
        redirect("/admin");
        break;
    case '/admin/formulariocamisa':
        BackDashboardController::renderizarFormularioCamisa();
        break;

    case '/admin/agregarcamisa':
        // Obtener los valores del formulario para enviarlo al controlador
        if($method === 'POST') {
            $shirt_name = $_POST['shirt_name'] ?? '';
            $shirt_categoria = 'camisa';
            $shirt_stock = 25;
            $shirt_price = $_POST['shirt_price'] ?? '';

            // Validaciones básicas
            if (!isset($_FILES['shirt_image']) || $_FILES['shirt_image']['error'] !== UPLOAD_ERR_OK) {
                // manejar error
                redirect('/admin?error=subida_imagen');
                break;
            }

            $tmpFile = $_FILES['shirt_image']['tmp_name'];
            $collection_id = $_POST['collection_id'] ?? '';

            // Obtener cuántas camisas hay en la colección
            $cantidadCamisas = ArticuloModel::contarPorID($collection_id, 'id_coleccion');
            $numeroCamisa = $cantidadCamisas + 1;

            $relativePath = "col{$collection_id}/jota{$numeroCamisa}.png";

            if (!storeAsset($relativePath, $tmpFile)) {
                redirect('/admin?error=guardar_imagen');
                break;
            }
            BackDashboardController::agregarCamisa($shirt_name, $shirt_categoria, $shirt_stock, $shirt_price, $relativePath, $collection_id);

        }
        redirect("/admin");
        break;
    case '/admin/alluser':
        BackDashboardController::alluser();
        break;
    case '/admin/allcoleciones':
        BackDashboardController::allColeccion();
        break;
    case '/admin/allarticulos':
        BackDashboardController::allArticulo();
        break;
    case '/admin/borrarusuario':
        $id = $_GET['id'] ?? null;
        BackDashboardController::borrarUsuario($id);
        break;
    case '/admin/borrarcoleccion':
        $id = $_GET['id'] ?? null;
        BackDashboardController::borrarColeccion($id);
        break;
    case '/admin/borrararticulo':
        $id = $_GET['id'] ?? null;
        BackDashboardController::borrarArticulo($id);
        break;
    // END BACK VIEWS
    default:
        abort(404, 'Page was not found');
        break;
}
