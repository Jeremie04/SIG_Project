<?php
   
    include("function.php");

    $arret = selectArret("A");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($arret as $row) {  ?>
       <?php
            echo " ".$row;
            $value = getArretBus($row);
            echo "  ".count($value)."  "."count"."  " ;
            for($i<0 ; $i<=count($value);$i++){
                echo $i;
                echo $value[2]['nomarret']."3";
                echo $value[$i]['nomarret'];
            }
        ?>
        <br>
    <?php } ?>
</body>
</html>
