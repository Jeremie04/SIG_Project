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
                center: new google.maps.LatLng(-18.93156126043269, 47.52016689079974),
                zoom: 14,
                mapTypeId:google.maps.MapTypeId.ROADMAP 
            };
        var carte = new google.maps.Map(document.getElementById("carte"), mapOptions); 
        var arrets = []

        getData(carte);
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
                <h2>Liste des lignes</h2>
                <a href="detail.php"><div class="opt">137</div></a>
                <a href="#"><div class="opt">172</div></a>
                <a href="#"><div class="opt">187</div></a>
            </div>
            <div class="content col-md-8">
                <div class="carte-content" id="carte">
    
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script src="accueil_func.js"></script>