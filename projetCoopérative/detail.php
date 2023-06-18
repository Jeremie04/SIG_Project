<?php include('header.php'); ?> 
<?php  

/* 
    $ArretProche = file_get_contents('jsonArretProche.php');
    $arretProche = json_decode($ArretProche, true);
    $latitudePlusProche = $arretProche['latitude'];
    $longitudePlusProche = $arretProche['longitude'];
    $listBus = getBusStopsBetween($latitudePlusProche, $longitudePlusProche, -18.987973284390698, 47.532374287954084, 1);
    $distance = getTotalDistance($latitudePlusProche, $longitudePlusProche, -18.987973284390698, 47.532374287954084, 1);
*/

$listBus = getBusStopsBetween(-18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 1);
$distance = getTotalDistance(-18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 1);
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
        //returnData();
        
        function getData(carte){
            var xhr = getxhr();
            xhr.addEventListener("load", function(event) {
                console.log(xhr.responseText);
                position = JSON.parse(xhr.responseText);
                //getBusStop(position.latitude, position.longitude, -18.987973284390698, 47.532374287954084);
                getBusStop(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084);
            });
            
            // Definissez ce qui se passe en cas d'erreur
            xhr.addEventListener("error", function(event) {
                alert('Oups! Quelque chose s\'est mal passé.');
            });
            
            // Configurez la requête
            xhr.open("POST", "jsonArretProche.php");
            alert(position.latitude);

            // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
            navigator.geolocation.getCurrentPosition(showPosition, showError);
            var formData = new FormData();
            formData.append('longitude', position.coords.longitude);
            formData.append('latitude', position.coords.latitude);
            xhr.send(formData);
        } 
        //getData(carte);
        // 137
        getBusStop(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 1, "red");
        getTrajet(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 1, "red");

        // 172
        getBusStop(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 2, "green");
        getTrajet(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 2, "green");

        // 187
        getBusStop(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 3, "blue");
        getTrajet(carte, -18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 3, "blue");
    }

    google.maps.event.addDomListener(window, 'load', initialize); // chargement de la carte
</script>


<body>
    <div class="container">
        

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
                        <td><a onclick='getBusAndTrajet(-18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 1, "red")'>137</a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a onclick='getBusAndTrajet(-18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 2, "green")'>172</a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a onclick='getBusAndTrajet(-18.998045725066667, 47.5358287947198, -18.987973284390698, 47.532374287954084, 3, "blue")'>181</a></td>
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