<?php

namespace rutas\Controladores;

class HomeController
{
    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        // your index view here
        render_view('home', [], 'home');
    }

}