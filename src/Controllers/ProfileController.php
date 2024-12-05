<?php
namespace App\Controllers;

use App\Views\View;

class ProfileController {
    public function profile() {
        $view = new View();
        $view->render('profile', ['title' => 'Profil']);
    }
}