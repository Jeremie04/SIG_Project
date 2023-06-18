<?php
    include('fonction.php');
    $trajet = getAllTrajets();
    $data=array(
        'l137' =>getTrajetByBus(1),
        'l172' =>getTrajetByBus(2),
        'l187' =>getTrajetByBus(3)
    );
    echo json_encode($data);
?>