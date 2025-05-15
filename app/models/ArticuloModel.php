<?php
require_once 'Model.php';

class ArticuloModel extends Model {
    protected static $table = 'articulos';
    protected static $primary_key = 'id_articulo'; // The primary key of the model

}
