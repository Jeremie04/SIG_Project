<?php
 include("connexion.php");
    function selectArret($mots) {
        $base = getconnection();
        $request = "SELECT idarret FROM arret WHERE nom LIKE :mots";
        $stmt = $base->prepare($request);
        $stmt->bindValue(':mots', '%' . $mots . '%', PDO::PARAM_STR);
        $stmt->execute();
        $tab = array();
        while ($rep = $stmt->fetch()) {
            $tab[] = $rep['idarret'];
        }
        return $tab;
    }
    function getArret($mots) {
        $base = getconnection();
        $request = "SELECT * FROM arret WHERE nom LIKE :mots";
        $stmt = $base->prepare($request);
        $stmt->bindValue(':mots', '%' . $mots . '%', PDO::PARAM_STR);
        $stmt->execute();
        $tab = array();
        while ($rep = $stmt->fetch()) {
            $tab[] = $rep;
        }
        return $tab;
    }
    function getArretBus($idArret){
        $base = getconnection();
        $request = "SELECT * FROM v_arretBus WHERE arret = %d";
        $request = sprintf($request,$idArret);
        echo $request;
        $response = $base -> query($request);
        $tab =array();
        while ($rep=$response->fetch()) $tab[] = $rep ;
        return $tab;
    }
    function getAllNameArret() {
        $base = getconnection();
        $request = "SELECT * FROM arret";
        $response = $base->query($request);
        $tab = array();
        while ($rep = $response->fetch()) {
            $tab[] = $rep;
        }
        return $tab;
    }
    function getLatitudeLongitude($latitudeDonnee, $longitudeDonnee, $listeArret) {
        $rayonTerre = 6371; // Rayon moyen de la Terre en kilomètres
        $latitudePlusProche = null;
        $longitudePlusProche = null;
        $distanceMin = null;
        foreach ($listeArret as $arret) {
            $latitude = $arret['latitude'];
            $longitude = $arret['longitude'];
    
            // Calcul de la distance entre les points
            $deltaLatitude = deg2rad($latitude - $latitudeDonnee);
            $deltaLongitude = deg2rad($longitude - $longitudeDonnee);
            $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) + cos(deg2rad($latitudeDonnee)) * cos(deg2rad($latitude)) * sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $rayonTerre * $c;

            if ($distanceMin === null || $distance < $distanceMin) {
                $distanceMin = $distance;
                $latitudePlusProche = $latitude;
                $longitudePlusProche = $longitude;
            }
        }
    
        // Renvoyer les coordonnées les plus proches
        return ['latitude' => $latitudePlusProche, 'longitude' => $longitudePlusProche, 'distance' => $distanceMin];
    }
    function getArretProche($latitude,$longitude){
        $base = getconnection();
        $request = "SELECT * FROM arret WHERE latitude = %d AND longitude = %d";
        $request = sprintf($request,$latitude,$longitude);
        $response = $base->query($request);
        $tab = array();
        while ($rep = $response->fetch()) {
            $tab[] = $rep;
        }
        return $tab;
    }
    
?>
