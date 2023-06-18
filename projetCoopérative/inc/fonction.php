<?php
   header( "Content-Type: application/json"); 
   
    function getLng_Lat($lng, $lat, $id, $database){
        $querry="SELECT longitude, latitude FROM Arret WHERE longitude='$lng' AND latitude='$lat' AND idArret='$id'";
        $res = $database->query($querry);
        $res->setFetchMode(PDO::FETCH_ASSOC); 
        $result = array();
        while( $donnees = $res->fetch()) 
        {
            array_push($result, $donnees);
        }
        for($i=0; $i<count($result); $i++){
            $retour = array(
                    0 => array("longitude"=>$result[$i][0], "latitude"=>$resultp[$i][1]),
            ); 
            echo json_encode($retour);
        }
        return $result;   
    }

    function distance($lon1, $lat1, $lon2, $lat2) {
        $earthRadius = 6371;  
    
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
    
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c;
    
        return $distance;
    }

    function getDistance($lng, $lat, $id, $id2, $database){
        $a =   getLng_Lat($lng, $lat, $id1);
        $b =   getLng_Lat($lng, $lat, $id2);

        $c=distance($a[0], $a[1], $b[0], $b[1]);

        return $c;
    }

    function getNbArret($longitude, $latitude){
        $querry="SELECT count(idArret) FROM Arret WHERE longitude<'$lon' AND latitude<'$latitude";
        $res = $database->query($querry);
        $res->setFetchMode(PDO::FETCH_ASSOC); 
        $result = array();
        while( $donnees = $res->fetch()) 
        {
            array_push($result, $donnees);
        }
        return result;
    }

    function getListeArret(){
        $querry="SELECT nom FROM Arret WHERE idArret IN (SELECT * FROM Arret JOIN Trajet e WHERE a.longitude=e.longitude)";
        $res = $database->query($querry);
        $res->setFetchMode(PDO::FETCH_ASSOC); 
        $result = array();
        while( $donnees = $res->fetch()) 
        {
            array_push($result, $donnees);
        }
        return result;
    }


   
?>