<?php
    include("fonction.php");
    $values=getAllNameArret();
    echo json_encode($values);
?>