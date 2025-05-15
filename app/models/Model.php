<?php

require_once __DIR__ . '/../../database/connector.php';


class Model
{
    protected static $table; // The name of the table associated with the model
    protected $attributes = []; // The attributes of the model
    public $values = []; // The sanitized values of the model
    private static $initialized = false; // A flag indicating whether the model has been initialized
    protected static $primary_key = 'id'; // The primary key of the model
    protected static $hidden = [];  // An array of attributes that should not be serialized

    /**
     * Sets the table name for the model based on the class name.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    protected function __construct(array $attributes, array $sanitized){
        self::init();
        $this->set_attributes($attributes); // Cambiar `self::` por `$this->`
        $this->values = $sanitized;
    }

    // Método mágico __get()
    public function __get($key)
    {
        return $this->attributes[$key] ?? null; // Devuelve el valor de los atributos o null si no existe
    }


    /**
     * Sanitiza los valores del modelo para evitar ataques de inyección SQL o XSS.
     *
     * @param array $data Los datos a sanitizar.
     * @return array Los datos sanitizados.
     */
    private static function sanitize(array $data)
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            if ($value === null) {
                $sanitized[$key] = null; // Mantener null si el valor original es null
            } else {
                $sanitized[$key] = htmlspecialchars(strip_tags($value));
            }
        }
        return $sanitized;
    }


    /**
     * Asigna los atributos al modelo.
     *
     * @param array $attributes Los atributos a asignar.
     */
    private function set_attributes(array $attributes)
    {
        $this->attributes = $attributes;
    }


    /**
     * Initializes the model by connecting to the database and setting the model attributes.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    protected static function init()
    {
        DB::connect(CONFIG['database'], CONFIG['database']['user'], CONFIG['database']['pass']);

        if (self::$initialized) {
            return;
        }

        if (empty(static::$table)){
            static::$table = strtolower(static::class) . 's';
        }

        self::$initialized = true;
    }

    /**
     * Almacena una instancia en la base de datos. La tabla es escogida
     * por el hijo de este modelo
     *
     * @param array $data Este arreglo almacena los datos de la instancia.
     *
     * @return void
     */
    public static function insertDB(array $data)
    {
        self::init();
        DB::insertar(static::$table, $data);
    }

    /**
     * Operacion SELECT de sql.
     *
     * @param array $columnas Las columnas que desea proyectar. Si
     * este parametro no se envia se asume que son toda las columnas
     *
     * @return model_list el modelo
     */
    public static function selectDB(array $columnas = ['*'])
    {
        self::init();
        $model_list = [];
        foreach (DB::select(static::$table, $columnas) as $model) {
            $model_list[] = new static($model, self::sanitize($model));
        }
        return $model_list;
    }

    public static function existeEnLaDB(array $data): bool
    {
        self::init(); // Asegura que la conexión está establecida
        $resultado = DB::where(static::$table, $data);

        return !empty($resultado); // Devuelve true si hay al menos un resultado, false si no hay coincidencias
    }

    public static function buscarEnLaDB(string $value, string $column = null, string $table = null): Model
    {
        self::init();
        $data = DB::whereONE($table ?? static::$table, $column ?? static::$primary_key, $value);

        if (empty($data)) {
            throw new ModelNotFoundException('There is no record with the given value: ' . $value);
        }

        return new static($data, self::sanitize($data));
    }

    /**
     * Returns all records from the associated table.
     *
     * @return array An array of associative arrays, where each key is the name of a
     *               column, and the value is the value of that column in the
     *               database.
     */
    public static function all()
    {
        self::init();

        $model_list = [];
        foreach (DB::select(static::$table, ['*']) as $model) {
            $model_list[] = new static($model, self::sanitize($model));
        }

        return $model_list;
    }

    public static function contarPorID(string $value, string $column = null, string $table = null): int
    {
        self::init();
        $resultado = DB::contar(
            $table ?? static::$table,
            $column ?? static::$primary_key,
            $value
        );
        return $resultado['total'] ?? 0;
    }

    public static function borrarDB(int $id)
    {
        self::init(); // Asegúrate de que esto conecte bien con la base
        DB::borrar(static::$table, static::$primary_key, $id);
    }

}