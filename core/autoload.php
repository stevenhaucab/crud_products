<?php

spl_autoload_register(function ($class) {
    $classPath = null; // Inicializar la variable para asegurar que esté definida.

    // Verifica si la clase pertenece al namespace "core"
    if (strpos($class, 'core\\') === 0) {
        // Convertir el namespace en una ruta de archivo dentro de la carpeta "core"
        $classPath = dirname(__DIR__, 1) . '/' . str_replace('\\', '/', $class) . '.php';

    // Verifica si la clase pertenece al namespace "App"
    } elseif (strpos($class, 'App\\') === 0) {
        $base_dir = dirname(__DIR__, 1) . '/src/';
        $relative_class = substr($class, strlen('App\\'));
        $classPath = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica si la clase pertenece al namespace "src"
    } elseif (strpos($class, 'src\\') === 0) {
        $base_dir = dirname(__DIR__, 1) . '/src/';
        $relative_class = substr($class, strlen('src\\'));
        $classPath = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        
    } else {
        // Debugging: el namespace no es ni "core", "App", ni "src"
        error_log("Namespace no reconocido para la clase: '$class'");
    }

    // Verificar si el archivo existe y cargarlo
    if ($classPath && file_exists($classPath)) {
        require_once $classPath;
    } else {
        // Debugging: mostrar la ruta del archivo que no se encontró
        error_log('No se encontró la clase: ' . $class . ' en la ruta: ' . ($classPath ?: 'Ruta no definida'));
    }
});
