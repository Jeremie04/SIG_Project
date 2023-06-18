<?php
    include("fonction.php");
    $value = $_GET['query'];
    //echo $value;
    $values=getArret($value);
    echo json_encode($values);
?>