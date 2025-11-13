<?php
// autoload.php

spl_autoload_register(function ($class) {
    // Convierte los \ de los namespaces a /
    $file = __DIR__ . '/app/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("No se pudo cargar la clase $class ($file)");
    }
});
