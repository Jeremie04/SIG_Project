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

    function getArretByBus($id){
        $connexion = connect();
        $sql="SELECT*FROM v_arretBus where ligne=".$id;
        $resultats=$connexion->query($sql);
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $rep=array();
        while( $ligne = $resultats->fetch())
        {
            $rep[] =$ligne;
        }
        $resultats->closeCursor();
        return $rep;       
    }

    function getTrajetByBus($id){
        $connexion = connect();
        $sql="SELECT*FROM Trajet where idligne=".$id;
        $resultats=$connexion->query($sql);
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $rep=array();
        while( $ligne = $resultats->fetch())
        {
            $rep[] =$ligne;
        }
        $resultats->closeCursor();
        return $rep;       
    }
?>