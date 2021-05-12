
DROP DATABASE IF EXISTS treknet;
CREATE DATABASE treknet;

USE treknet;

CREATE TABLE IF NOT EXISTS Profil(
    num_profil SMALLINT PRIMARY KEY,
    pseudo VARCHAR(30),
    photo_de_profil VARCHAR(100),
    email VARCHAR(50),
    mot_de_passe VARCHAR(100),
    num_section TINYINT,
    num_grade TINYINT,
    date_inscription DATE,
    langue VARCHAR(15),
    espece VARCHAR(20)
);

ALTER TABLE `profil` CHANGE `date_inscription` `date_inscription` DATE NULL DEFAULT CURRENT_TIMESTAMP; 


CREATE TABLE Abonnement(
    num_profil_suivi SMALLINT,
    num_profil_suivant SMALLINT
);

CREATE TABLE Publication(
    num_publication MEDIUMINT PRIMARY KEY,
    num_profil SMALLINT,
    date_publication DATE,
    image VARCHAR(100),                 
    texte VARCHAR(1000)
);

ALTER TABLE `publication` CHANGE `date_publication` `date_publication` DATE NULL DEFAULT CURRENT_TIMESTAMP; 

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

ALTER TABLE `message` ADD `mess` VARCHAR(1000) NOT NULL AFTER `num_destinataire`; 




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

INSERT INTO  Abonnement(num_profil_suivi, num_profil_suivant)
     VALUES  (1,2),
	     (2,1),
	     (2,3),
	     (1,3);


