<?php
namespace App\Controllers\MessagesController;


use App\Utils\DatabaseConnection;

class Messages
{
    public function displayMessages()
    {
        require __DIR__ . '/../../../templates/messages.php';
    }
}
