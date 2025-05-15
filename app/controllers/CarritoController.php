<?php
require_once 'Controller.php';

class CarritoController extends Controller
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

        //Empezar el carrito
        $carrito = $_SESSION['carrito'] ?? [];
        $cantidadEnCarrito = array_sum(array_column($carrito, 'cantidad'));

        $carritoDetallado = [];
        foreach ($carrito as $item) {
            // Buscar artículo en la base de datos
            $articulo = ArticuloModel::buscarEnLaDB($item['id'], 'id_articulo');

            // Buscar nombre de la colección
            $coleccion = ColeccionModel::buscarEnLaDB($articulo->id_coleccion, 'id_coleccion');

            // Añadir información al array detallado
            $carritoDetallado[] = [
                'id' => $item['id'],
                'imagen'     => $articulo->imagen,
                'nombre'     => $articulo->nombre,
                'categoria'  => $articulo->categoria,
                'stock'      => $articulo->stock,
                'precio'     => $articulo->precio,
                'cantidad'   => $item['cantidad'],
                'subtotal'   => $item['cantidad'] * $articulo->precio,
                'coleccion'  => $coleccion->nombre
            ];
        }
        //termino el carrito

        // Now call render_view with the defined variables
        render_view('carrito', [
            'email' => $email,
            'carrito' => $carritoDetallado,
            'cantidadEnCarrito' => $cantidadEnCarrito
        ], 'Carrito');
    }

    //Agregar un  producto
    public static function agregarProducto($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener el carrito actual de la sesión o crear uno nuevo
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Buscar el artículo en la base de datos
        $checkProducto = ArticuloModel::existeEnLaDB(['id_articulo' => $id]);
        if (!$checkProducto) {
            // Maneja el error si no se encuentra el producto
            $_SESSION['error'] = "Producto no encontrado.";
            header("Location: /"); // Puedes redirigir a donde quieras
            exit;
        } else {
            $producto = ArticuloModel::buscarEnLaDB($id, 'id_articulo');
        }

        // Verificar si ya está en el carrito
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] += 1;
        } else {
            // Agregar producto con cantidad 1
            $_SESSION['carrito'][$id] = [
                'id' => $producto->id_articulo,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'imagen' => $producto->imagen,
                'cantidad' => 1
            ];
        }

        // Puedes redirigir al usuario a la misma página o al carrito
        header("Location: " . $_SERVER['HTTP_REFERER']); // Regresa a la página anterior
        exit;
    }

    public static function actualizar($id, $accion)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['carrito'][$id])) {
            echo json_encode(['success' => false]);
            exit;
        }

        if ($accion === 'mas') {
            $_SESSION['carrito'][$id]['cantidad']++;
        } elseif ($accion === 'menos') {
            $_SESSION['carrito'][$id]['cantidad']--;
            if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id]);
                echo json_encode(['success' => true, 'nueva_cantidad' => 0]);
                exit;
            }
        }

        echo json_encode(['success' => true, 'nueva_cantidad' => $_SESSION['carrito'][$id]['cantidad']]);
    }

    public static function eliminar($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
