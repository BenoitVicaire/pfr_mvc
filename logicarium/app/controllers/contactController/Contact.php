<?php
namespace App\Controllers\ContactController;


use App\Utils\DatabaseConnection;

class Contact
{
    public function displayContact()
    {
        require __DIR__ . '/../../../templates/contact.php';
    }
}
