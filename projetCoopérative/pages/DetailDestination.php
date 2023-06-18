<?php
    include('../inc/fonction.php');
    include("inc/connecxion.php");
    $database=connect();
    $distance = getDistance();
    echo json_encode($distance);
?>