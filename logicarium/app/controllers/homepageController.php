<?php
namespace App\Controllers\HomepageController;


use App\utils\Database\DatabaseConnection;

class Homepage
{
    public function displayHomepage()
    {
        require __DIR__ . '/../../templates/homepage.php';
    }
}
