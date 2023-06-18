<?php
    function trouverPlusProche($latitudeDonnee, $longitudeDonnee, $listePoints) {
        $rayonTerre = 6371; // Rayon moyen de la Terre en kilomètres
    
        // Variables pour stocker les coordonnées les plus proches
        $latitudePlusProche = null;
        $longitudePlusProche = null;
        $distanceMin = null;
    
        // Parcourir la liste des points et calculer la distance avec chaque point
        foreach ($listePoints as $point) {
            $latitude = $point['latitude'];
            $longitude = $point['longitude'];
    
            // Calcul de la distance entre les points
            $deltaLatitude = deg2rad($latitude - $latitudeDonnee);
            $deltaLongitude = deg2rad($longitude - $longitudeDonnee);
            $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) + cos(deg2rad($latitudeDonnee)) * cos(deg2rad($latitude)) * sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $rayonTerre * $c;
    
            // Comparaison avec la distance minimale actuelle
            if ($distanceMin === null || $distance < $distanceMin) {
                $distanceMin = $distance;
                $latitudePlusProche = $latitude;
                $longitudePlusProche = $longitude;
            }
        }
    
        // Renvoyer les coordonnées les plus proches
        return ['latitude' => $latitudePlusProche, 'longitude' => $longitudePlusProche, 'distance' => $distanceMin];
    }
        $latitudeDonnee = 48.8566; // Latitude de la position donnée
    $longitudeDonnee = 2.3522; // Longitude de la position donnée

    $listePoints = [
        ['latitude' => 40.7128, 'longitude' => -74.0060], // Exemple de point 1
        ['latitude' => 51.5074, 'longitude' => -0.1278], // Exemple de point 2
        ['latitude' => 37.7749, 'longitude' => -122.4194] // Exemple de point 3
    ];

    $resultat = trouverPlusProche($latitudeDonnee, $longitudeDonnee, $listePoints);

    // Affichage des résultats
    echo "Latitude la plus proche : " . $resultat['latitude'] . "<br>";
    echo "Longitude la plus proche : " . $resultat['longitude'] . "<br>";
    echo "Distance minimale : " . $resultat['distance'] . " km";

?>