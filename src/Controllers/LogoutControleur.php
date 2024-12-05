<?php
namespace App\Controllers;

use App\Models\Logout;

class LogoutControleur
{
    public function logout()
    {
    
        $logout = new Logout();
        $logout->logout();

       
        header('Location:' .URL);
        exit;
    }
}