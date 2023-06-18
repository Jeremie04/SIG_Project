function openPopup() {
    var popupOverlay = document.getElementById('popup-overlay');
    popupOverlay.style.visibility = 'visible';
}

function closePopup() {
    var popupOverlay = document.getElementById('popup-overlay');
    popupOverlay.style.visibility = 'hidden';
}

function returnData() {
    var data = null;
    var dataInput = document.getElementById('searchInput');
    data = dataInput.value;
    console.log('Données renvoyées depuis la fenêtre pop-up : ' + data);
    closePopup();
    $.ajax({
        url: 'jsonArretFiltre.php',
        type: 'POST',
        data: { data: data },
        success: function(response) {
            console.log('Réponse du script PHP : ' + response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
function updateValue(value) {
    document.getElementById('output').textContent = value;
}
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        console.log("La géolocalisation n'est pas prise en charge par ce navigateur.");
    }
}
function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    console.log("Latitude: " + latitude);
    console.log("Longitude: " + longitude);

    $.ajax({
        url: 'jsonArretProche.php',
        type: 'POST',
        data: {
            latitude: latitude,
            longitude: longitude
        },
        success: function(response) {
            console.log("Réponse du fichier PHP : " + response);
            // Faire quelque chose avec la réponse du fichier PHP
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            console.log("L'utilisateur a refusé la demande de géolocalisation.");
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("Les informations de position ne sont pas disponibles.");
            break;
        case error.TIMEOUT:
            console.log("La demande de géolocalisation a expiré.");
            break;
        case error.UNKNOWN_ERROR:
            console.log("Une erreur inconnue s'est produite.");
            break;
    }
}
function escapeRegExp(str) {
    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}