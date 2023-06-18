<?php
    include ("fonction.php");
    if(isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $arret = getAllNameArret();
        $resultat = getLatitudeLongitude($latitude,$longitude,$arret);
        echo json_encode($resultat);
    } else {
        echo "Erreur : Données de latitude et de longitude manquantes";
    }
?>
