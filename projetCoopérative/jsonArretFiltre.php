<?php
    include("fonction.php");
    if (isset($_POST['data'])){
        $value = $_POST['data'];
        $values=getArretBus($value);
        echo json_encode($values);
    }
?>