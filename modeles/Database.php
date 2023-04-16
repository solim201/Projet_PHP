<?php

namespace modeles;


use PDO;
use PDOException;

class Database {
    private static $instance = null;
    protected $conn;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "bibliotheque";

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function prepare($string)
    {
       # return $this->conn->prepare($string);
    }
}
