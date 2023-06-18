<?php  
    include('fonction.php');
    $listBus = getBusStopsBetween(-18.904737095855467, 47.52427131081365, -18.987973284390698, 47.532374287954084, 1);
    $distance = getTotalDistance(-18.904737095855467, 47.52427131081365, -18.987973284390698, 47.532374287954084, 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>


<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?sensor=false"> // chargement de l'API Maps JavaScript
</script>

<script type="text/javascript">
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-18.915532645126166, 47.52166406471127),
            zoom: 15,
        };
        var carte = new google.maps.Map(document.getElementById("carte"), mapOptions); 


        getBusStop(carte);
        getTrajet(carte);
    }

    google.maps.event.addDomListener(window, 'load', initialize); // chargement de la carte
</script>


<body>
    <div class="container">
        <?php include('header.php'); ?>

        <!-- liste d'arrêt -->
        <div class="row">
            <div class="option col-md-4">
                <a href="accueil.php">Revenir à l'accueil</a>
                <table class="table table-striped ">
                    <tr>
                        <td><strong>Distance</strong></td>
                        <td><?php echo $distance ?> mètres</td>
                    </tr>
                    <tr>
                        <td><strong>nb Arrêt</strong></td>
                        <td><?php echo count($listBus); ?> arrêts</td>
                    </tr>
                    <tr rowspan="3">
                        <td ><strong>Liste Bus</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>137</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>181</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>172</td>
                    </tr>
                </table>
                  
            </div>
            <div class="content col-md-8">
                <div class="carte-content" id="carte">
    
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<script src="detail_func.js"></script>