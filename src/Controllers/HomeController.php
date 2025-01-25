<?php

namespace App\Controllers;

use core\Controller;
use core\View;

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'System',
            'content' => 'System'
        ];

        // Renderizar la vista 'home'
        View::render('home', $data);
    }
}
