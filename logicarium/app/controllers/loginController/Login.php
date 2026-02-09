<?php
namespace App\Controllers\LoginController;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Model\LoginModel\LoginRepository;
use App\Model\UserModel\User;
use App\Utils\DatabaseConnection;

class Login {
    // Verifie email et password => connecte user
    public function login(string $email,string $password): void{
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
                'id' => $user->getId(),
                'email' => $user->getEmail(),
            ];
            $_SESSION['logged']=true;
            header('Location: index.php?action=login');
            exit;
        }else{
            throw new \Exception('Identifiant incorrect');
        }
    }
    // Déconnexion
    public function logout():void{
        session_destroy();
        header('Location: index.php');
        exit;
    }
    // Créer un compte utilisateur
    public function createAccount(string $email, string $password, string $password2, string $name):void{
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
        $user->setEmail($email);
        $user->setPassword($passwordHashed);
        $user->setName($name);

        $loginRepository->createAccount($user);
        $_SESSION['flash_succes']= "Le compte a été crée avec succès";
        header('Location: index.php?action=login&tab=connexion');
        exit;
    }

    public function displayLoginPage():void{
        $succesMessage = $_SESSION['flash_succes'] ?? '';
        unset($_SESSION['flash_succes']);
        require_once __DIR__ . '/../../templates/login.php';
    }
}

