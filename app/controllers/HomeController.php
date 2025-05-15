<?php
require_once 'Controller.php';
require 'app/models/ColeccionModel.php';
require 'app/models/ArticuloModel.php';

class HomeController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_SESSION['email'] ?? null;

        // Para renderizar las coleciones con el articulo
        $colecciones = ColeccionModel::all();
        $articulos = ArticuloModel::all();
        // Agrupar artículos por colección
        $coleccionesConArticulos = [];
        // Este codigo esta bueno !!
        foreach ($colecciones as $coleccion) {
            $coleccionId = $coleccion->id_coleccion;
            $coleccionesConArticulos[] = [
                'coleccion' => $coleccion,
                'camisas' => array_filter($articulos, function ($articulo) use ($coleccionId) {
                    return $articulo->categoria === 'camisa' && $articulo->id_coleccion == $coleccionId;
                }),
            ];
        }
        // Se acabo el codigo bueno

        //Empezar el carrito
        $carrito = $_SESSION['carrito'] ?? [];
        $cantidadEnCarrito = array_sum(array_column($carrito, 'cantidad'));
        //termino el carrito

        render_view('home', [
            'email' => $email,
            'coleccionesConCamisas' => $coleccionesConArticulos,
            'carrito' => $carrito,
            'cantidadEnCarrito' => $cantidadEnCarrito
        ], 'Home');
    }

    // define your other methods here
    public static function homePageWithUser()
    {
        // Verifica si la sesión no está activa antes de iniciarla
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }
        $email = $_SESSION['email'] ?? null; // Obtener email de la sesión

        // Para renderizar las coleciones con el articulo
        $colecciones = ColeccionModel::all();
        $articulos = ArticuloModel::all();
        // Agrupar artículos por colección
        $coleccionesConArticulos = [];
        // Este codigo esta bueno !!
        foreach ($colecciones as $coleccion) {
            $coleccionId = $coleccion->id_coleccion;
            $coleccionesConArticulos[] = [
                'coleccion' => $coleccion,
                'camisas' => array_filter($articulos, function ($articulo) use ($coleccionId) {
                    return $articulo->categoria === 'camisa' && $articulo->id_coleccion == $coleccionId;
                }),
            ];
        }
        // Se acabo el codigo bueno
        // Para renderizar las coleciones con el articulo

        render_view('home', [
            'email' => $email,
            'coleccionesConCamisas' => $coleccionesConArticulos
        ], 'Home');
    }

}
