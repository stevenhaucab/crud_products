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
        'eliminar-categoria/{id}' => 'CategoriasController@delete',
        'productos' => 'ProductosController@index',
        'nuevo-producto' => 'ProductosController@create',
        'editar-producto/{id}' => 'ProductosController@edit',
        'eliminar-producto/{id}' => 'ProductosController@delete',
    ],
    'POST' => [
        'login' => 'AuthController@login',
        'register' => 'RegisterController@store',
        'nuevo-categoria' => 'CategoriasController@store',
        'editar-categoria/{id}' => 'CategoriasController@update',
        'eliminar-categoria/{id}' => 'CategoriasController@delete',
        'nuevo-producto' => 'ProductosController@store',
        'editar-producto/{id}' => 'ProductosController@update',
        'eliminar-producto/{id}' => 'ProductosController@delete',
    ],
    'protected' => [
        '',
        'home',
    ],
];
