<?php 
namespace App\Controllers\forumController;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/forumModel.php';

use App\Model\LoginModel\LoginRepository;
use App\Utils\Database\DatabaseConnection;

class Forum{
    public function displayForum(){
        require __DIR__ . '/../../templates/forum/forum.php';
    }
}

