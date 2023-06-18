<?php 
    include("fonction.php");
?>

<!--  Header  -->
<div class="row header">
    <h1 id="titre">Web Application : Bus 137, 187, 172</h1>
    <button onclick="openPopup()">Choisir une destination</button>
</div>


<!--  Popup  -->
<script src="popup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>

<div id="popup-overlay" class="popup-overlay">
    <div class="popup-content">
        <h3>Saisir votre destination</h3>
        <h4>Recherche d'options :</h4>
        <input type="text" id="searchInput" placeholder="Votre destination">
            <script>
                                           $(document).ready(function() {
    $.ajax({
        url: 'jsonArret.php',
        type: 'GET',
        success: function(response) {
            console.log(response);
            var result = JSON.parse(response);
            var options = [];
            for (var i = 0; i < result.length; i++) {
                options.push({ value: result[i]['idarret'], text: result[i]['nom'] });
            }
            $('#searchInput').selectize({
                options: options,
                labelField: 'text',
                searchField: 'text',
                placeholder: 'Votre destination',
                create: false
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});



            </script>
        <button onclick="closePopup()"> annuler</button>
        <!--<button onclick="returnData()">est ma destination</button>-->
        <a href="detail.php"><button>est ma destination</button></a>
    </div>
</div>