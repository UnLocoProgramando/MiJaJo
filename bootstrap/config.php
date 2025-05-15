<?php

// Intentar cargar el archivo .env
if (file_exists(__DIR__ . '/../.env')) {
    $env = [];

    $filePath = __DIR__ . '/../.env';
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Ignorar los comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Dividir la línea en clave y valor
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Categorizar las configuraciones según el prefijo
        if (strpos($key, 'db_') === 0) {
            $env['database'][substr($key, 3)] = $value; // Quitar el prefijo 'db_'
        } elseif (strpos($key, 'app_') === 0) {
            $env['app'][substr($key, 4)] = $value; // Quitar el prefijo 'app_'
        } elseif (strpos($key, 'mail_') === 0) {
            $env['mailer'][substr($key, 5)] = $value; // Quitar el prefijo 'mail_'
        }
    }

    return $env;  // Devuelve la configuración cargada desde el archivo .env
} else {
    // Si no se encuentra el archivo .env, usar configuración predeterminada
    return [
        'database' => [
            'service' => 'mysql',
            'host' => '127.0.1.1',
            'port' => 3306,
            'dbname' => 'jotadb',
            'user' => 'joseph33',
            'pass' => 'Joseph1@', // Cambia la contraseña por la correcta
        ],
        'app' => [
            'name' => 'JotaWear',
            'debug' => true,
        ],
        'mailer' => [
            'mail_mailer' => 'smtp',
            'mail_host' => 'sandbox.smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => '8c5f52efef456e',
            'mail_password' => '3fbe8d1e9965b9',
        ]
    ];
}
