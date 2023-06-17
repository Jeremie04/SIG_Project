<?php
   function connect(){
        $user='finoana';
        $pass='mdpprom15';
        $dsn='pgsql:host=localhost;port=5432;dbname=bus';

        try {
        	$dbh = new PDO($dsn, $user, $pass);
        	return $dbh;
        } catch (PDOException $e) {
        	print "Erreur ! : " . $e->getMessage();
        	die();
        }
    }
?>

