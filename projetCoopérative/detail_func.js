function getxhr(){
    try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    catch (e) 
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
        catch (e2) 
        {
            try {  xhr = new XMLHttpRequest();  }
            catch (e3) {  xhr = false;   }
        }
    }
    return xhr;
}

        
function getBusStop(carte) {
    arrets = [];
    var xhr = getxhr();

    xhr.addEventListener("load", function(event){
        arrets = JSON.parse(xhr.responseText.trim());
        arrets.forEach(item => {
            var marker = new google.maps.Marker({   
                position: new google.maps.LatLng(item.latitude,item.longitude), 
                draggable: false, 				
                map: carte ,
                label:{
                    text: item.nomarret,
                    color: "white",
                    fontWeight: "bold"
                }   
            });
        });
    });
        
    // Definissez ce qui se passe en cas d'erreur
    xhr.addEventListener("error", function(event) {
        alert('Oups! Quelque chose s\'est mal passé.');
    });

    xhr.open("POST", "getDetails.php");
    
    // Configurez la requête
    var formData = new FormData();
    formData.append('departLong', 47.52427131081365);
    formData.append('departLat', -18.904737095855467);
    formData.append('arrivLong', 47.532374287954084);
    formData.append('arrivLat', -18.987973284390698);
    formData.append('ligne', 1);
    xhr.send(formData);
}


function getTrajet(carte){
    var points = []
    var xhr = getxhr();
    xhr.addEventListener("load", function(event) {
        console.log(xhr.responseText);
        points = JSON.parse(xhr.responseText);
        var ligne = []
        points.forEach(item => {
            ligne.push(new google.maps.LatLng(item.latitude,item.longitude))
        });
        var traceLigne = new google.maps.Polyline({
            path: ligne,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        traceLigne.setMap(carte);
    });
    
    xhr.addEventListener("error", function(event) {
        alert('Oups! Quelque chose s\'est mal passé.');
    });

    xhr.open("POST", "getTrajet.php");
    // Configurez la requête
    var formData = new FormData();
    formData.append('departLong', 47.52427131081365);
    formData.append('departLat', -18.904737095855467);
    formData.append('arrivLong', 47.532374287954084);
    formData.append('arrivLat', -18.987973284390698);
    formData.append('ligne', 1);
    xhr.send(formData);
}