<?php  
    include('fonction.php');
    $departLong = $_POST['departLong'];
    $departLat = $_POST['departLat'];
    $arrivLong = $_POST['arrivLong'];
    $arrivLat = $_POST['arrivLat'];
    $ligne = $_POST['ligne'];
    $listBus = getBusStopsBetween($departLat, $departLong, $arrivLat, $arrivLong, $ligne);
    echo json_encode($listBus);
?>
