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

INSERT INTO  Publication(num_profil, image, texte)
     VALUES  (1,'../Images/Publications/popi.jpeg','Mon Popi trop migno qui dort !!!'),
	     (1,'../Images/Publications/zigotos.jpeg','Les trois zigotos sur la route ;)'),
	     (2,'../Images/Publications/croquettes.png','Mon repas d'anniversaire. Ce fut vraiment délicieux, merci à ma chère maitresse
	      Soline pour m'avoir préparé ce repas avec tant d'amour. Je t'aime <3'),
	     (3,'../Images/Publications/micky.jpeg','Micky vient de prendre son bain.'),
	     (3,'../Images/Publications/popi_drole.jpeg','Muerdele Popi !!');


INSERT INTO  Abonnement(num_profil_suivi, num_profil_suivant)
     VALUES  (1,2),
	     (2,1),
	     (2,3),
	     (1,1),
	     (2,2),
	     (3,3),
	     (1,3);
	     
	     
	     
             




