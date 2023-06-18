<?php
    include('./fonction.php');
    header('Content-Type: application/json');

    $nomBus=$_GET['nom'];

    $data=array(
        'arret' => getArretByBus($nomBus),
        'trajet' =>getTrajetByBus($nomBus)
    );
    
    echo json_encode($data);
?>
