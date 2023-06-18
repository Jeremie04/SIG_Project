function initialize() {
    var mapOptions = {
            center: new google.maps.LatLng(-18.93156126043269, 47.52016689079974),
            zoom: 13,
            mapTypeId:google.maps.MapTypeId.ROADMAP 
        };
    var carte = new google.maps.Map(document.getElementById("carte"), mapOptions); 
    var arrets = []
    // get all the bus stop
    function getData(carte){
        var arrets = []
        var xhr; 
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
        // Définissez ce qui se passe si la soumission s'est opérée avec succès
        xhr.addEventListener("load", function(event) {
            arrets = JSON.parse(xhr.responseText);
            arrets.forEach(item => {
                var marker = new google.maps.Marker({   
                    position: new google.maps.LatLng(item.latitude,item.longitude), 
                    draggable: false, 				
                    map: carte ,
                    label:{
                        text: item.nom,
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
    
        // Configurez la requête
        xhr.open("GET", "allArret.php");
    
        // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
        xhr.send(null);
    }
    function getTrajet(carte){
        var arrets = []
        var xhr; 
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
        // Définissez ce qui se passe si la soumission s'est opérée avec succès
        xhr.addEventListener("load", function(event) {
            arretsTab = JSON.parse(xhr.responseText);
                var arret137 = arretsTab.l137;
                var arret172 = arretsTab.l172;
                var arret187 = arretsTab.l187;

                function traceArret(arrets,couleur){
                    var ligne = []
                    arrets.forEach(item => {
                        ligne.push(new google.maps.LatLng(item.latitude,item.longitude))
                    });
                    var traceLigne = new google.maps.Polyline({
                        path: ligne,//chemin du tracé
                        strokeColor: couleur,//couleur du tracé
                        strokeOpacity: 1.0,//opacité du tracé
                        strokeWeight: 2//grosseur du tracé
                    });
                    traceLigne.setMap(carte);
                }
                
                traceArret(arret137,"Green");
                traceArret(arret187,"Red");
                traceArret(arret172,"Blue");
        });
        
        // Definissez ce qui se passe en cas d'erreur
        xhr.addEventListener("error", function(event) {
        alert('Oups! Quelque chose s\'est mal passé.');
        });
    
        // Configurez la requête
        xhr.open("GET", "allTrajet.php");
    
        // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
        xhr.send(null);
    }
    getData(carte);
    getTrajet(carte);
}

google.maps.event.addDomListener(window, 'load', initialize); // chargement de la carte
