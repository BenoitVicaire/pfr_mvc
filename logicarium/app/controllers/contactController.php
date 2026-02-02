<?php
namespace App\Controllers\ContactController;


use App\utils\Database\DatabaseConnection;

class Contact
{
    public function displayContact()
    {
        require __DIR__ . '/../../templates/contact.php';
    }
}
