create database bus;
\c bus;

create table ligne(
    idLigne serial primary key ,
    nom VARCHAR(3)
);
create table arret(
    idArret serial primary key,
    nom VARCHAR(100),
    latitude DOUBLE PRECISION,
    longitude DOUBLE PRECISION
);
create table arret_bus(
    idArret integer ,
    idLigne integer,
    foreign key (idArret) references arret(idArret),
    foreign key (idLigne) references ligne(idLigne)
);


insert into ligne(nom) values ('137'),('172'),('187');


insert into arret(nom,latitude,longitude) values('fiadanamanga',-18.998045725066667, 47.5358287947198);
insert into arret(nom,latitude,longitude) values('mandrimena',-18.992117338249816, 47.53291160758549);
insert into arret(nom,latitude,longitude) values('galana',-18.987973284390698, 47.532374287954084);
insert into arret(nom,latitude,longitude) values('boulangerie',-18.98368471878886, 47.53274403216737);
insert into arret(nom,latitude,longitude) values('pharmacie',-18.979979485844723, 47.533017308713596);
insert into arret(nom,latitude,longitude) values('Andoharanofotsy',-18.977203357311325, 47.53300927116966);
insert into arret(nom,latitude,longitude) values('malaza',-18.97165844648551, 47.53036399008118);
insert into arret(nom,latitude,longitude) values('Ambany Atsimo',-18.96726124357736, 47.53013090126282);
insert into arret(nom,latitude,longitude) values('Magasin M',-18.963589851350495, 47.529628554676755);
insert into arret(nom,latitude,longitude) values('Tetezan I Tanjombato',-18.954681592828067, 47.529183332908524);
insert into arret(nom,latitude,longitude) values('Barage',-18.952629973819057, 47.52782298452786);
insert into arret(nom,latitude,longitude) values('Fasika',-18.948246576324372, 47.525671031679295);
insert into arret(nom,latitude,longitude) values('Ankadimbahoaka',-18.943024642568727, 47.52358571683994);

insert into arret(nom,latitude,longitude) values('Tetezana - Soanierana',-18.93816833043606, 47.52129232939798);
insert into arret(nom,latitude,longitude) values('Tsena Namontana',-18.935931184144675, 47.51452533486912);
insert into arret(nom,latitude,longitude) values('Rond-Point Namontana',-18.93531745656585, 47.509740312271745);
insert into arret(nom,latitude,longitude) values('Mpivaro-Kena Nosybe',-18.93048526044065, 47.509868766433044);
insert into arret(nom,latitude,longitude) values('Akoho Anosibe',-18.926971545192593, 47.51245822311391);
insert into arret(nom,latitude,longitude) values('Tsena Anosibe',-18.925101889169188, 47.511586631901785);
insert into arret(nom,latitude,longitude) values('SONATRA',-18.9226483788855, 47.508598534194626);
insert into arret(nom,latitude,longitude) values('Shell Andavamamba',-18.92103926669201, 47.5083004770852);
insert into arret(nom,latitude,longitude) values('Andavamamba',-18.918467761739766, 47.508565937068354);
insert into arret(nom,latitude,longitude) values('Fokotonany-Andavamamba',-18.913481182791443, 47.508915336128105);
insert into arret(nom,latitude,longitude) values('Trente-67Ha',-18.910427664564004, 47.50608121336328);
insert into arret(nom,latitude,longitude) values('Ny HAVANA 67Ha',-18.904944203588734, 47.50802578753254);


insert into arret(nom,latitude,longitude) values('Descours', -18.935458108471273, 47.52239232065213);
insert into arret(nom,latitude,longitude) values('Paraky',-18.93156126043269, 47.52016689079974);
insert into arret(nom,latitude,longitude) values('Jirama AA', -18.926026350938056, 47.51977104153224);
insert into arret(nom,latitude,longitude) values('Toby',-18.92287127377572, 47.52082585270103);
insert into arret(nom,latitude,longitude) values('Anosy', -18.918275557765547, 47.52199419961647);
insert into arret(nom,latitude,longitude) values('Rm1 - Andohan Analakely', -18.90964454624482, 47.52720666916968);
insert into arret(nom,latitude,longitude) values('Tohatoha-Baton Ambondrona', -18.906847216471842, 47.526621961904155);
insert into arret(nom,latitude,longitude) values('Terminus 137- Analakely', -18.904737095855467, 47.52427131081365);

insert into arret_bus(idLigne,idArret) values(1,1),(2,1),(3,1),(1,2),(2,2),(3,2),(1,3),(2,3),(3,3),
                                             (1,4),(2,4),(3,4),(1,5),(2,5),(3,5),(1,6),(2,6),(3,6),
                                             (1,7),(2,7),(3,7),(1,8),(2,8),(3,8),(1,9),(2,9),(3,9),
                                             (1,10),(2,10),(3,10),(1,11),(2,11),(3,11),(1,12),(2,12),
                                             (3,12),(1,13),(2,13),(3,13),(2,14),(3,14),(2,15),(3,15),
                                             (2,16),(3,16),(2,17),(3,17),(2,18),(3,18),(2,19),(3,19),
                                             (2,20),(3,20),(2,21),(3,21),(2,22),(3,22),(2,23),(3,23),
                                             (2,24),(3,24),(2,25),(3,25),(1,26),(1,27),(1,28),(1,29),
                                             (1,30),(1,31),(1,32),(1,33);

create or replace view v_arretBus as 
    select a.nom as nomArret , a.latitude latitude , a.longitude longitude , 
            l.nom nomLigne , a.idArret arret , l.idLigne ligne
    from arret_bus ab 
    join arret a on a.idArret = ab.idArret
    join ligne l on l.idLigne=ab.idLigne;
                                             
create table trajet(
    idTrajet serial primary key,
    idLigne int,
    latitude DOUBLE PRECISION,
    longitude DOUBLE PRECISION
);

-- import csv de 172
COPY trajet(idLigne,latitude,longitude) FROM '172.csv' DELIMITER ',' CSV HEADER;
                                             
                                             
INSERT INTO trajet(idLigne,latitude,longitude)
VALUES
(3, -18.99806855, 47.53582343),
(3, -18.997652628, 47.535667862),
(3, -18.99742945, 47.535431828),
(3, -18.997216416, 47.535018768),
(3, -18.99682078, 47.534332122),
(3, -18.996668613, 47.534187283),
(3, -18.996465722, 47.534112181),
(3, -18.996201964, 47.534176554),
(3, -18.995796182, 47.534391131),
(3, -18.995494005, 47.535002674),
(3, -18.995270824, 47.535238709),
(3, -18.994865039, 47.535292353),
(3, -18.994657074, 47.534680809),
(3, -18.994195493, 47.534160461),
(3, -18.993236819, 47.533624019),
(3, -18.992196981, 47.532942738),
(3, -18.991020181, 47.532164897),
(3, -18.990381054, 47.532132711),
(3, -18.989593051, 47.532202448),
(3, -18.986874183, 47.532470669),
(3, -18.986316201, 47.532808627),
(3, -18.985950975, 47.53296956),
(3, -18.98543357, 47.533044662),
(3, -18.985053125, 47.533050026),
(3, -18.982374764, 47.532492127),
(3, -18.981871518, 47.532524313),
(3, -18.981029446, 47.532771076),
(3, -18.979326609, 47.5329464),
(3, -18.977145931, 47.532921254),
(3, -18.975718849, 47.532663762),
(3, -18.975348527, 47.532518923),
(3, -18.974139452, 47.531835824),
(3, -18.973282122, 47.531412035),
(3, -18.972507883, 47.530965805),
(3, -18.970380046, 47.529501319),
(3, -18.970200282, 47.529415488),
(3, -18.969987213, 47.529313564),
(3, -18.969692974, 47.529463768),
(3, -18.969332785, 47.530166507),
(3, -18.969305405, 47.530984764),
(3, -18.969092335, 47.531408553),
(3, -18.968727072, 47.531456833),
(3, -18.968407465, 47.531172519),
(3, -18.967692154, 47.53028739),
(3, -18.9673229, 47.530138718),
(3, -18.965603092, 47.529773938),
(3, -18.963619457, 47.529602276),
(3, -18.961143686, 47.529639827),
(3, -18.958657697, 47.529661285),
(3, -18.957734333, 47.52942525),
(3, -18.956963168, 47.529548632),
(3, -18.956334057, 47.52924286),
(3, -18.955175759, 47.529855704),
(3, -18.954896715, 47.529228067),
(3, -18.954303891, 47.528952969),
(3, -18.952720936, 47.527853263),
(3, -18.950995531, 47.526614082),
(3, -18.948608905, 47.525789659),
(3, -18.947658583, 47.525405292),
(3, -18.944644748, 47.524450426),
(3, -18.943571416, 47.523991544),
(3, -18.943114766, 47.523626764),
(3, -18.942703781, 47.523363908),
(3, -18.942328312, 47.522983034),
(3, -18.942162919, 47.522875227),
(3, -18.939483869, 47.522156395),
(3, -18.938290473, 47.52191693),
(3, -18.93819153, 47.521396581),
(3, -18.938343751, 47.520543639),
(3, -18.938130641, 47.519953553),
(3, -18.936451126, 47.518805568),
(3, -18.936243088, 47.518356314),
(3, -18.935969086, 47.514628044),
(3, -18.935618973, 47.512739768),
(3, -18.935400785, 47.511961928),
(3, -18.93551749, 47.509853711),
(3, -18.935369868, 47.509676945),
(3, -18.934278928, 47.509752047),
(3, -18.93164542, 47.510497701),
(3, -18.930856917, 47.51044236),
(3, -18.930192188, 47.509417756),
(3, -18.929918177, 47.509315832),
(3, -18.929683704, 47.509462234),
(3, -18.926979082, 47.512337562),
(3, -18.92639253, 47.512855391),
(3, -18.926240298, 47.512860755),
(3, -18.922761108, 47.508706358),
(3, -18.922277105, 47.508116272),
(3, -18.921637715, 47.508191374),
(3, -18.920013854, 47.508384493),
(3, -18.919232103, 47.508625501),
(3, -18.918612999, 47.508604043),
(3, -18.918267923, 47.508400195),
(3, -18.916390295, 47.508604043),
(3, -18.916125417, 47.508669351),
(3, -18.912517261, 47.508932208),
(3, -18.910782509, 47.509255563),
(3, -18.910447567, 47.505650675),
(3, -18.910330845, 47.505635718),
(3, -18.909128093, 47.505740133),
(3, -18.907324647, 47.505888627),
(3, -18.906491569, 47.505949149),
(3, -18.905735392, 47.506013522),
(3, -18.904882786, 47.506077895),
(3, -18.904750835, 47.506088623),
(3, -18.904933537, 47.508003721);            
                                             

                                            
