<?php
namespace App\Controllers\ProfilController;

use App\utils\Database\DatabaseConnection;

class Profil
{
    public function displayProfil()
    {
        require __DIR__ . '/../../../templates/profil.php';
    }
}
