<?php
session_start();
require_once __DIR__ . '/../app/controllers/homepageController.php';
require_once __DIR__ . '/../app/controllers/loginController.php';

use Application\Controllers\Homepage;
use App\controllers\loginController\Login;

try{
    if(isset($_GET['action']) && $_GET['action'] !== ''){
        if ($_GET['action'] === 'login') {
            (new Login())->login($_POST['email'],$_POST['password']);
        }
    }else {
        
    }
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('../templates/errors.php');
}