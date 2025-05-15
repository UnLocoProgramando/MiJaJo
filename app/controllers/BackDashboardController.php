<?php
require_once 'Controller.php';

class BackDashboardController extends Controller
{

    /**
     * This renders the index view.
     * @return void
     */
    public static function index()
    {
        // Verifica si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        // Asegurarse que el usuario tenga una sección
        $email = $_SESSION['email'] ?? null;

        // Para el Formulario de agregar camisas
        $colecciones = ColeccionModel::all();

        // Now call render_view with the defined variables
        render_view('backDashboard', ['email'=> $email, 'colecciones' => $colecciones], 'BackDashboard');
    }

    public static function agregarColeccion($collection_name)
    {
        if(ColeccionModel::existeEnLaDB(['nombre' => $collection_name])) {
            echo "Ya existe";
            return;
        }
        ColeccionModel::insertDB(['nombre' => $collection_name]);
    }

    public static function agregarCamisa($shirt_name, $shirt_categoria, $shirt_stock, $shirt_price, $relativePath, $collection_id)
    {
        if(ArticuloModel::existeEnLaDB(['nombre' => $shirt_name])) {
            echo "Ya existe";
            return;
        }

        $data = [
            'nombre' => $shirt_name,
            'categoria' => $shirt_categoria,
            'stock' => $shirt_stock,
            'precio' => $shirt_price,
            'imagen' => $relativePath,
            'id_coleccion' => $collection_id
        ];

        ArticuloModel::insertDB($data);
    }

    public static function alluser()
    {
        // Verifica si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        // Asegurarse que el usuario tenga una sección
        $email = $_SESSION['email'] ?? null;

        // Obtener todo los usuarios de la DB
        $todoLosUsuarios = UserModel::all();

        // Now call render_view with the defined variables
        render_view('backAllUser', ['email'=> $email, 'usuarios' => $todoLosUsuarios], 'BackAllUser');
    }

    public static function allColeccion()
    {
        // Verifica si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        // Asegurarse que el usuario tenga una sección
        $email = $_SESSION['email'] ?? null;

        // Obtener todo los usuarios de la DB
        $todoLasColeciones = ColeccionModel::all();

        // Now call render_view with the defined variables
        render_view('backAllColeciones', ['email'=> $email, 'coleciones' => $todoLasColeciones], 'BackAllColeciones');
    }

    public static function allArticulo()
    {
        // Verifica si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        // Asegurarse que el usuario tenga una sección
        $email = $_SESSION['email'] ?? null;

        // Obtener todo los usuarios de la DB
        $todoLosArticulos = ArticuloModel::all();

        // Now call render_view with the defined variables
        render_view('backAllArticulos', ['email'=> $email, 'articulos' => $todoLosArticulos], 'BackAllArticulos');
    }

    public static function borrarUsuario(int $id)
    {
        if ($id) {
            UserModel::borrarDB((int)$id);
        }

        BackDashboardController::alluser();
        exit;
    }

    public static function borrarColeccion(int $id)
    {
        if ($id) {
            ColeccionModel::borrarDB((int)$id);
        }
        BackDashboardController::allColeccion();
        exit;
    }

    public static function borrarArticulo($id)
    {
        if($id) {
            ArticuloModel::borrarDB((int)$id);
        }
        BackDashboardController::allArticulo();
        exit;
    }

    public static function renderizarFormularioCollecion()
    {
        // Verifica si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        // Asegurarse que el usuario tenga una sección
        $email = $_SESSION['email'] ?? null;

        // Para el Formulario de agregar camisas
        $colecciones = ColeccionModel::all();

        // Now call render_view with the defined variables
        render_view('formcolecciones', ['email'=> $email, 'colecciones' => $colecciones], 'BackDashboard');

    }

    public static function renderizarFormularioCamisa() {
        // Verifica si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        // Asegurarse que el usuario tenga una sección
        $email = $_SESSION['email'] ?? null;

        // Para el Formulario de agregar camisas
        $colecciones = ColeccionModel::all();

        // Now call render_view with the defined variables
        render_view('formcamisa', ['email'=> $email, 'colecciones' => $colecciones], 'BackDashboard');
    }
}
