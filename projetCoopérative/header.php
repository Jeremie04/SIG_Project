<?php 
    include("fonction.php");
?>

<!--  Header  -->
<div class="row header">
    <h1 id="titre">Web Application : Bus 137,182, 172</h1>
    <button onClick="openPopup()">Choisir une destination</button>
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
                    $('#searchInput').selectize({
                        valueField: 'value',
                        labelField: 'text',
                        searchField: 'text',
                        placeholder: 'Sélectionnez une option',
                        create: false,
                        load: function(query, callback) {
                            if (!query.length) return callback();
                            
                            $.ajax({
                                url: 'jsonArret.php',
                                type: 'GET',
                                dataType: 'json',
                                data: {
                                    query: query
                                },
                                success: function(response) {
                                    callback(response);
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    });
                });

        </script>
        <button onclick="closePopup()"> annuler</button>
        <button onclick="returnData()">est ma destination</button>
    </div>
</div>