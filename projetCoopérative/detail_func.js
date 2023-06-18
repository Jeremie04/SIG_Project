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

        
function getBusStop(carte,  departLat, departLong, arrivLat, arrivLong, line, color) {
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
                },
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillColor: color, // Couleur du marqueur (ici, rouge)
                    fillOpacity: 1,
                    strokeWeight: 0,
                    scale: 10
                  },
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
    formData.append('departLong', departLong);
    formData.append('departLat', departLat);
    formData.append('arrivLong', arrivLong);
    formData.append('arrivLat', arrivLat);
    formData.append('ligne', line);
    xhr.send(formData);
}


function getTrajet(carte,  departLat, departLong, arrivLat, arrivLong, line, color){
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
            strokeColor: color,
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
    formData.append('departLong', departLong);
    formData.append('departLat', departLat);
    formData.append('arrivLong', arrivLong);
    formData.append('arrivLat', arrivLat);
    formData.append('ligne', line);
    xhr.send(formData);
}

function getBusAndTrajet(  departLat, departLong, arrivLat, arrivLong, line, color){
    var options = {
        center: new google.maps.LatLng(departLat , departLong),
        zoom: 14,
        mapTypeId:google.maps.MapTypeId.ROADMAP 
    };
    var carte = new google.maps.Map(document.getElementById("carte"), options);
    getBusStop(carte,  departLat, departLong, arrivLat, arrivLong, line, color);
    getTrajet(carte,  departLat, departLong, arrivLat, arrivLong, line, color);
}