<?php
namespace App\Models;

class Logout
{
    public function logout()
    {
        session_start();
        session_unset(); // Supprime toutes les variables de session
        session_destroy(); // Détruit la session
    }
}
