function arret(nom,couleur) {
    var options = {
        center: new google.maps.LatLng(-18.9980457250667 , 47.5358287947198),
        zoom: 14,
        mapTypeId:google.maps.MapTypeId.ROADMAP 
    };

    var carte = new google.maps.Map(document.getElementById("carte"), options);

    var xhr = new XMLHttpRequest();
        
    xhr.open("GET", './arretByBus.php?nom='+nom, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var tableau=JSON.parse(xhr.responseText);
            var tab=tableau.arret;
            var tab1=tableau.trajet;

            var location=new Array();
            var trace=new Array();

            for (let i = 0; i < tab.length; i++) {
                var element = tab[i];
                location.push(new google.maps.Marker ({ 
                    position: new google.maps.LatLng(element.latitude,element.longitude),
                    map: carte,
                    label:{
                        text: element.nomarret,
                        color: "white",
                        fontWeight: "bold"
                    },
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: couleur, // Couleur du marqueur (ici, rouge)
                        fillOpacity: 1,
                        strokeWeight: 0,
                        scale: 10
                      },
                }));
            }

            for (let i = 0; i < tab1.length; i++) {
                var element = tab1[i];
                trace.push(new google.maps.LatLng(element.latitude,element.longitude));
            }
            
            var traceParcours= new google.maps.Polyline({
                path: trace,
                strokeColor: couleur,
                strokeOpacity: 1.0,
                strokeWeight: 2,
                map: carte,
            });

            var p1=document.getElementById('h31');
            var p2=document.getElementById('h32');
            
            p1.textContent="Bus: "+tab[0].nomligne;
            p2.textContent="Nombre Arrêt: "+tab.length;

            var div=document.getElementById("arret");
            // div.removeChild();
            div.appendChild(p1);
            div.appendChild(p2);
        }
    };  
    xhr.send();
}