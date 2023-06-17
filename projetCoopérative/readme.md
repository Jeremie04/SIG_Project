How to import csv into database
mettre dans un dossier le csv, ou le dossier a un chmod 777

puis executer la commande:
COPY trajet(idLigne,latitude,longitude) FROM '172.csv' DELIMITER ',' CSV HEADER;
dans pgsql

remplacer '172.csv' par son path
