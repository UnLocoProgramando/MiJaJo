<?php
require_once 'Controller.php';

class RegistrarController extends Controller
{

    /**
     * This renders the index view.
     * @return void
     */
    public static function index()
    {
        // Now call render_view with the defined variables
        render_view('registrar', [], 'registrar');
    }

}
