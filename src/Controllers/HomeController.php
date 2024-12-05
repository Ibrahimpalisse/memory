<?php
namespace App\Controllers;

use App\Views\View;

class HomeController {
    public function index() {
        $view = new View();
        $view->render('home', ['title' => 'Home']);
    }
}