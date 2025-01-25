<?php

namespace core;

class View
{
    public static function render($view, $data = [])
    {
        // Convertir el array $data en variables individuales
        extract($data);

        // Asegurarse de que el archivo tenga la extensión .php
        if (strpos($view, '.php') === false) {
            $view .= '.php';
        }

        // Definir el path de las vistas partiendo de la raíz del proyecto
        $file = dirname(__DIR__) . '/src/Views/' . $view;

        // Verificar si la vista existe
        if (file_exists($file)) {
            require $file;
        } else {
            die("View not found: " . $file);
        }
    }
}
