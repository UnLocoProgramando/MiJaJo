<?php


final class DB
{
    private static $database; /* The PDO instance for the database connection.*/
    private static $database_name; /* The name of the database.*/


    /**
     * Connects to the database using the environment variables, or the default values
     * if they are not set.
     *
     *
     * If the connection fails, an Error exception is thrown.
     *
     * @throws Error if there is an error connecting to the database.
     */
    public static function connect($connection, $user = 'root', $password = '')
    {

        $dsn = CONFIG['database']['service'] . ':host=' . $connection['host'] . ';dbname=' . $connection['dbname'] . ';charset=utf8';

        try {

            self::$database = new PDO($dsn, $user, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // defining class properties

            self::$database_name = $connection['dbname'];


        } catch (PDOException $e) {
            throw new DatabaseConnectionException("Error connecting to the database with driver '". CONFIG['database']['service'] . "': " . $e->getMessage(), 0, $e);
        }
    }

    public static function insertar(string $table, array $data)
    {
        if (!self::$database) {
            die("Error: No hay conexión con la base de datos.");
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        var_dump($sql);
        $stmt = self::$database->prepare($sql);
        return $stmt->execute($data);
    }

    public static function select(string $table, array $columnas)
    {
        // Convertimos el array de columnas en un string separada por comas
        $columnas_str = implode(", ", $columnas);

        $sql = "SELECT $columnas_str FROM " . self::$database_name . ".$table";

        $statement = self::$database->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function where(string $table, array $columnas)
    {
        // Asegúrate de que la conexión está establecida
        self::connect(CONFIG['database'], CONFIG['database']['user'], CONFIG['database']['pass']);

        $sql = "SELECT * FROM $table WHERE ";
        $conditions = [];
        $values = [];

        // Generamos las condiciones basadas en las columnas y valores proporcionados
        foreach ($columnas as $columna => $valor) {
            $conditions[] = "$columna = ?";
            $values[] = $valor;
        }

        // Unimos las condiciones con 'AND'
        $sql .= implode(" AND ", $conditions);

        // Preparamos y ejecutamos la consulta
        $stmt = self::$database->prepare($sql);
        $stmt->execute($values);

        // Retornamos los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function whereONE(string $table, string $where, string $equal, string $column = '*', string $operator = '='): array
    {
        $operator = in_array($operator, ['=', '>', '<', '>=', '<=', '!=']) ? $operator : '=';
        $sql = "SELECT $column FROM " . self::$database_name . ".$table WHERE $where $operator :equal";

        $statement = self::$database->prepare($sql);
        $statement->bindValue(':equal', $equal, PDO::PARAM_STR);
        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results ?: [];
    }

    public static function contar(string $table, string $where, string $equal, string $column = '*', string $operator = '='): array
    {
        $operator = in_array($operator, ['=', '>', '<', '>=', '<=', '!=']) ? $operator : '=';
        $sql = "SELECT COUNT($column) as total FROM " . self::$database_name . ".$table WHERE $where $operator :equal";

        $statement = self::$database->prepare($sql);
        $statement->bindValue(':equal', $equal, PDO::PARAM_STR);
        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results ?: [];
    }

    public static function borrar(string $table, string $where, string $equal): bool
    {
        $sql = "DELETE FROM `$table` WHERE `$where` = :equal";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':equal', $equal);
        $statement->execute();
        return $statement->rowCount() > 0;
    }

}

