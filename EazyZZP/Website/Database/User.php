<?php

require_once 'db.php';
$userDB = new User();



class User
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    // User inloggen
    public function loginUser($email)
    {
        return $this->pdo->run("SELECT * FROM account WHERE email = :email", ["email" => $email])->fetch();
    }


    // User registreren 
    public function registerUser($name, $surname, $email, $phoneNumber, $password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $this->pdo->run("INSERT INTO account (name, surname, email, phonenumber, password) VALUES (:name, :surname, :email, :phonenumber, 
        :password)",["name" => $name, "surname" => $surname, "email" => $email, "phonenumber" => $phoneNumber, "password" => $hashed]);
    }

    // Users ophalen
    public function SelectUser($email){
        return $this->pdo->run("SELECT email FROM account WHERE email = :email", ['email' => $email])->fetch();
    }
    public function personalDetails($account_id){
        return $this->pdo->run("SELECT * FROM account WHERE id = :id", ['id' => $account_id])->fetch();
    }

    
}