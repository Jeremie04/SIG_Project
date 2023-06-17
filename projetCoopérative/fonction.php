<?php 
    include('connection.php');

    function getBusStopByLine($line) {
        $conn = connexion();
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
?>