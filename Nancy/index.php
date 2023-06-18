<?php 
    include("function.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ma page principale</title>
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            visibility: hidden;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
    <script src="popup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>

</head>
<body>
    <button onclick="openPopup()">Ouvrir la fenêtre pop-up</button>

    <div id="popup-overlay" class="popup-overlay">
        <div class="popup-content">
            <h2>Saisir votre destination</h2>
            <h2>Recherche d'options :</h2>
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
                <button onclick="returnData()">est ma destination</button>
        </div>
    </div>
</body>
</html>
