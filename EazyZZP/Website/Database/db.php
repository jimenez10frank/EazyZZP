<?php

class Database{
    public $pdo;
    
    public function __construct($db = "eazyzzp", $user = "root", $pwd = "", $host = "127.0.0.1:3306")
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Run je queries gelijk 
    public function run($sql, $plcd = null){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($plcd);
        return $stmt;
    }
};

