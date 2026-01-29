<?php
namespace App\controllers\loginController;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../utils/database.php';
require_once __DIR__ . '/../models/loginModel.php';

use App\Model\LoginModel\LoginRepository;
use App\model\LoginModel\User;
use App\Utils\Database\DatabaseConnection;

class Login {
    // Verifie email et password => connecte user
    public function login(string $email,string $password){
        if(!$email || !$password){
            throw new \Exception('Idendifiant manquants');  
        }
        $loginRepository = new LoginRepository(new DatabaseConnection());
        $user = $loginRepository->getUserByEmail($email);

        if(!$user){
            throw new \Exception('Identifiant incorrect');
        }

        if(password_verify($password,$user['password'])){
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],

            ];
            $_SESSION['logged']=true;
            header('Location: index.php?action=login');
        }else{
            throw new \Exception('Identifiant incorrect');
        }
    }
    // Déconnexion
    public function logout(){
        session_destroy();
        header('Location: index.php');
    }
    // Créer un compte utilisateur
    public function createAccount(string $email, string $password, string $password2, string $name){
        if(!isset($email, $password, $password2, $name)){
            throw new \Exception("Informations manquantes");
        }
        // Validation + sanitize Email
        $email=filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception("Email invalide");
        }
        // Validation + hash Password
        if($password !== $password2){
            throw new \Exception('Les deux mot de passe saisie sont differents');
        }
        if(strlen($password)<4){
            throw new \Exception('Mot de passe trop court');
        }
        $passwordHashed=password_hash($password, PASSWORD_DEFAULT);
        // Sanitize name
        $name=htmlspecialchars(strip_tags($name));
        // Connection à la DB
        $loginRepository = new LoginRepository(new DatabaseConnection());
        // Check si l'email existe
        $user= $loginRepository->getUserByEmail($email);
        if($user){
            throw new \Exception("Email déja existant"); 
        }
        // Créer le compte
        $user=new User;
        $user->email=$email;
        $user->password=$passwordHashed;
        $user->name=$name;

        $loginRepository->createAccount($user);
        $_SESSION['flash_succes']= "Le compte a été crée avec succès";
        header('Location: index.php?action=login&tab=connexion');
    }

    public function displayLoginPage(){
        $succesMessage = $_SESSION['flash_succes'] ?? '';
        unset($_SESSION['flash_succes']);
        require_once __DIR__ . '/../../templates/login.php';
    }
}

