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


select * from v_arretBus where idArret = select idArret from arret where nom like '%%';
                                             
                                             
                                             
                                             
                                             
                                             

                                            

