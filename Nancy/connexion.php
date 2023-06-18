<?php  
    function getconnection(){
        try {
            $connexion = new PDO('pgsql:host=localhost;dbname=bus', "postgres", "mdpprom13");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connexion;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
?>