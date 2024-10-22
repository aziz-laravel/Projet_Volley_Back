<?php 

class Connexion { 

    private $connexion; 

    public function __construct() { 
        $host = 'localhost'; 
        $dbname = 'school1'; 
        $login = 'root'; 
        $password = ''; 

        try { 
            // Set the charset to utf8 or utf8mb4 directly in the DSN
            $this->connexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $login, $password); 
            // This line is no longer necessary since we set the charset in the DSN
            // $this->connexion->query("SET NAMES UTF8"); 
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) { 
            die('Erreur : ' . $e->getMessage()); 
        } 
    } 

    function getConnexion() { 
        return $this->connexion; 
    } 

} 
