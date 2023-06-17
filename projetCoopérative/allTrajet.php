<?php
    include('fonction.php');
    $trajet = getAllTrajets();
    echo json_encode($trajet);
?>