<?php
    include('fonction.php');
    $arrets = getAllArrets();
    echo json_encode($arrets);
?>