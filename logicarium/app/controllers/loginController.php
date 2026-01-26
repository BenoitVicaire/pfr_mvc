<?php

namespace App\controllers\loginController;

require_once('app/utils/database.php');
require_once('app/utils/login.php');
require_once('app/model/loginModel.php');

use App\model\loginModel;
use App\utils\Database\DatabaseConnection;

class Login {
    public function login($email,$password){
        $email=$_POST['email'];
        $password=$_POST['password'];

        $connection = new DatabaseConnection();

    }
}

