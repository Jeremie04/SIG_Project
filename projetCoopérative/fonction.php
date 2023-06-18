<?php 
    include('connection.php');

    function getBusStopByLine($line) {
        $conn = connect();
        $sql = "SELECT * FROM v_arretBus WHERE ligne = :line";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':line', $line, PDO::PARAM_INT);
        $stmt->execute();
        $busStops = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $busStops;
    }


    function getAllArrets(){
        $conn = connect();
        $sql = "SELECT*FROM arret";
        $busStops = array();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $busStops = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $busStops;
    }

    function getAllTrajets(){
        $conn = connect();
        $sql = "SELECT*FROM trajet";
        $busTrajet = array();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $busTrajet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $busTrajet;
    }



    function getTrajetByLine($line){
        $conn = connect();
        $sql = "SELECT * FROM trajet WHERE idligne = :line";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':line', $line, PDO::PARAM_INT);
        $stmt->execute();
        $busStops = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $busStops;        
    }


    function distance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371;  
    
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
    
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c;
    
        return $distance * 1000;
    }
     
    function getBusStopsBetween($startLat, $startLon, $endLat, $endLon, $line) {
        $listArret = getBusStopByLine($line);
        $busStops = []; 

        foreach ($listArret as $arret) {
            $busStopLat = $arret['latitude'];
            $busStopLon = $arret['longitude'];
            
            $distanceStartToEnd = distance($startLat, $startLon, $endLat, $endLon);
            $distanceToStart = distance($startLat, $startLon, $busStopLat, $busStopLon);
            $distanceToEnd = distance($endLat, $endLon, $busStopLat, $busStopLon);
    
            if ($distanceToStart <= $distanceStartToEnd && $distanceToEnd <= $distanceStartToEnd) {
                echo $arret['latitude'];
                $busStops[] = $arret; 
            }
        }
    
        return $busStops;
    }

    function getPointsBetween($startLat, $startLon, $endLat, $endLon, $line) {
        $listpoint = getTrajetByLine($line);
        $points = []; 

        foreach ($listpoint as $point) {
            $busStopLat = $point['latitude'];
            $busStopLon = $point['longitude'];
            
            $distanceStartToEnd = distance($startLat, $startLon, $endLat, $endLon);
            $distanceToStart = distance($startLat, $startLon, $busStopLat, $busStopLon);
            $distanceToEnd = distance($endLat, $endLon, $busStopLat, $busStopLon);
    
            if ($distanceToStart <= $distanceStartToEnd && $distanceToEnd <= $distanceStartToEnd) {
                $points[] = $point; 
            }
        }
    
        return $points;
    }

    function getTotalDistance($startLat, $startLon, $endLat, $endLon, $line){
        $points = getPointsBetween($startLat, $startLon, $endLat, $endLon, $line);
        $totalDistance = 0;

        // Calcul de la somme des distances entre les points
        for ($i = 0; $i < count($points) - 1; $i++) {
            $lat1 = $points[$i]['latitude'];
            $lon1 = $points[$i]['longitude'];
            $lat2 = $points[$i+1]['latitude'];
            $lon2 = $points[$i+1]['longitude'];

            $distance = distance($lat1, $lon1, $lat2, $lon2);
            $totalDistance += $distance;
        }    
        
        return $totalDistance;
    }
?>