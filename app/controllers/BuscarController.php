<?php
require_once 'Controller.php';

class BuscarController extends Controller
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

        $email = $_SESSION['email'] ?? null; // Obtener email de la sesión
        // Now call render_view with the defined variables
        render_view('buscar', ['email'=>$email], 'buscar');
    }

}
