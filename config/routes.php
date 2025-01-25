<?php

return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',
        'login' => 'AuthController@showLoginForm', 
        'register' => 'RegisterController@showForm', 
        'categorias' => 'CategoriasController@index',
        'nueva-categoria' => 'CategoriasController@create',
        'editar-categoria/{id}' => 'CategoriasController@edit',
        'productos' => 'ProductosController@index',
        'nuevo-producto' => 'ProductosController@create',
        'editar-producto/{id}' => 'ProductosController@edit',
    ],
    'POST' => [
        'login' => 'AuthController@login',
        'register' => 'RegisterController@store',
        'nuevo-categoria' => 'CategoriasController@store',
        'editar-categoria/{id}' => 'CategoriasController@update',
        'nuevo-producto' => 'ProductosController@store',
        'editar-producto/{id}' => 'ProductosController@update',
    ],
    'protected' => [
        '',
        'home',
        'desarrollos',
    ],
];
