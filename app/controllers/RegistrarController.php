<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class RegistrarController extends Controller
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
        render_view('registrar', ['email'=>$email], 'registrar');
    }

    public static function registrarUsuario($email, $existe, $esUser)
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión solo si no está activa
        }

        if ($existe) {
            //si es user
            if($esUser == 'user'){
                $_SESSION['email'] = $email;
                HomeController::homePageWithUser();
            }
            //si es admin
            if($esUser == 'admin'){
                $_SESSION['email'] = $email;
                header("Location: /admin");
                BackDashboardController::index();
            }

        } else {
            // Si el usuario no esta registrado en la base de datos
            $data = [
                'user_id' => null,
                'email' => $email,
                'password' => null,
                'nombre' => null,
                'apellidos' => null,
                'direccion' => null,
                'apartamento' => null,
                'cuidad' => null,
                'estado' => null,
                'codigo_postal' => null,
                'telefono' => null,
                'tipo' => 'user',
                'creado' => date('Y-m-d H:i:s')
            ];
            UserModel::insertDB($data);
            // Guardar email en la sesión y redirigir a home
            $_SESSION['email'] = $email;
            HomeController::homePageWithUser();
        }
    }
}
