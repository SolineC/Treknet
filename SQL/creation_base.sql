
DROP DATABASE IF EXISTS treknet;
CREATE DATABASE treknet;

USE treknet;

CREATE TABLE Profil(
    num_profil SMALLINT PRIMARY KEY,
    pseudo VARCHAR(30),
    photo_de_profil VARCHAR(100),
    email VARCHAR(50),
    mot_de_passe VARCHAR(100),
    num_section TINYINT,
    num_grade TINYINT,
    date_inscription DATE,
    espece VARCHAR(20),
    description VARCHAR(1000),
    admi BOOLEAN
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



CREATE TABLE Message(
    expediteur VARCHAR(30),
    destinataire VARCHAR(30),
    mess VARCHAR(1000),
    date_message TIMESTAMP
);








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
             (1,1),
             (2,2);


INSERT INTO  Profil (num_profil, pseudo, photo_de_profil, email, mot_de_passe, num_section, num_grade, date_inscription, espece, description, admi)
     VALUES  (1,'Soline','../Images/Profil/spock1.jpg','soline@corm.eu', '$2y$10$IOSZMO2BH0og4x.cu5BN0OhsOYLIIBLeRxep6sC0qVg8nSjx7kQlK', 2, 0,2020-07-06,'Humain','Fondatrice',1),
             (2,'Ana','../Images/Profil/chapel.jpg','ana.parres27@gmail.com','$2y$10$Klmyr.4cFkA//f2p1bSJeO85ESgppkOG5rNNY95YnmjzK0./JBieu', 3, 0,2020-08-27,'Humain','Fondatrice',1);

