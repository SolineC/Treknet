
DROP DATABASE IF EXISTS treknet;
CREATE DATABASE treknet;

USE treknet;

CREATE TABLE IF NOT EXISTS Profil(
    num_profil SMALLINT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(30),
    photo_de_profil VARCHAR(100),
    email VARCHAR(50),
    mot_de_passe VARCHAR(100),
    num_section TINYINT,
    num_grade TINYINT,
    date_inscription DATE,
    langue VARCHAR(15)
);

ALTER TABLE `profil` CHANGE `date_inscription` `date_inscription` DATE NULL DEFAULT CURRENT_TIMESTAMP; 


CREATE TABLE Abonnement(
    num_profil_suivi SMALLINT,
    num_profil_suivant SMALLINT
);

CREATE TABLE Publication(
    num_publication MEDIUMINT,
    num_profil SMALLINT,
    date_publication DATE,
    image VARCHAR(100),                 
    texte VARCHAR(1000)
);

CREATE TABLE Section(
    num_section TINYINT,
    nom_section VARCHAR(15),
    couleur VARCHAR(10)
);

CREATE TABLE Grade(
    num_grade TINYINT,
    nom_grade VARCHAR(30),
    administrateur_publications BOOLEAN,
    administrateur_comptes BOOLEAN
);

CREATE TABLE Langue(
    langues VARCHAR(10)
);

CREATE TABLE Message(
    num_expediteur SMALLINT,
    num_destinataire SMALLINT
);


INSERT INTO  Profil (pseudo, num_section, num_grade, mot_de_passe, langue, email, date_inscription, photo_de_profil)
     VALUES  ('James T. Kirk', 1, 7, 'BeamMeUpScotty','Anglais','kirk@entreprise.com',2020-04-15, '../Images/Profil/kirk1.jpg'),
             ('Spock', 2, 6, 'LiveLong','Anglais','spock@entreprise.com',2020-04-04, '../Images/Profil/spock1.jpg'),
             ('Scotty', 3, 4, 'iLoveEntreprise','Anglais','scotty@entreprise.com',2020-04-10, '../Images/Profil/scotty.jpg'),
	     ('Bones McCoy', 2, 4, 'imADoctor','Anglais','mccoy@entreprise.com',2020-04-10, '../Images/Profil/mccoy.jpg'),
	     ('Uhura', 3, 3, 'letstalk','Anglais','uhura@entreprise.com',2020-04-12, '../Images/Profil/uhura.png'),
	     ('kirkdu94', 3, 3, 'letstalk','Anglais','uhura@entreprise.com',2020-04-12,'../Images/Profil/chapel.jpg'),
	     ('TheRealKirk', 3, 3, 'letstalk','Anglais','uhura@entreprise.com',2020-04-12, '../Images/Profil/kirk2.jpg'),
	     ('Tiberius Kirk', 1, 7, 'BeamMeUpScotty','Anglais','kirk@entreprise.com',2020-04-15, '../Images/Profil/kirkdouglas.jpg'),
	     ('kirk_-_shatner', 1, 7, 'BeamMeUpScotty','Anglais','kirk@entreprise.com',2020-04-15, '../Images/Profil/mecimaginaire1.jpg'),
	     ('06kirk78', 1, 7, 'BeamMeUpScotty','Anglais','kirk@entreprise.com',2020-04-15, '../Images/Profil/kirk1.jpg'),
	     ('James-Kirk', 1, 7, 'BeamMeUpScotty','Anglais','kirk@entreprise.com',2020-04-15, '../Images/Profil/kirk1.jpg'),
	     ('Soline', 2, 11, 'bbb','Français','soso@free.fr',2020-04-15, '../Images/Profil/kirk1.jpg');




INSERT INTO  Langue (langues)
     VALUES  ('Français'),
             ('Espagnol'),
             ('Anglais'),
	     ('Klingon');


INSERT INTO  Grade (num_grade, nom_grade, administrateur_publications, administrateur_comptes)
     VALUES  (0,"Membre d'équipage",0,0),
             (1,'Enseigne',0,0),
             (2,'Sous-Lieutenant',0,0),
	     (3,'Lieutenant',0,0),
 	     (4,'Lieutenant-Commander',0,0),
   	     (5,'Commander',0,0),
	     (6,'Capitaine',0,0),
   	     (7,'Capitaine de flotte',0,0),
	     (8,'Contre-Amiral',1,0),
   	     (9,'Vice-Amiral',1,0),
	     (10,'Amiral',1,1),
   	     (11,'Amiral de flotte',1,1);


INSERT INTO  Section (num_section, nom_section, couleur)
     VALUES  (1,'Opération','Jaune'),
             (2,'Scientifique','Bleu'),
             (3,'Navigation','Rouge');


