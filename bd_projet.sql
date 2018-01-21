
CREATE TABLE professeur (
    idProf INT(11) NOT NULL,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    PRIMARY KEY (idprof)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO professeur (idProf, nom, prenom) VALUES ( '0', 'Bacrat', 'Olivier');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '1', 'Lescaut', 'Julie');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '2', 'Canet', 'Sabrina');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '3', 'Gerard', 'Sebastien');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '4', 'Dupont', 'Valentin');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '5', 'Flamand', 'Bernard');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '6', 'Freon', 'Patrick');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '7', 'Berger', 'Marc');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '8', 'Hubert', 'Annie');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '9', 'Roger', 'Marie');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '10', 'André', 'Paul');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '11', 'Carlisle', 'Henry');
INSERT INTO professeur (idProf, nom, prenom) VALUES ( '12', 'Claudet', 'Antoine');

CREATE TABLE creneau (
    id INT(11) NOT NULL AUTO_INCREMENT,
    idProf INT(11) NOT NULL,
    dateDebut TIMESTAMP,
    duree FLOAT DEFAULT '0' NOT NULL,
    exclusivite BOOLEAN DEFAULT '0' NOT NULL,
    datePublic TIMESTAMP,
    libre BOOLEAN DEFAULT '0' NOT NULL,
	  commentaireAvant VARCHAR(50) NOT NULL,
    aEuLieu BOOLEAN DEFAULT '0' NOT NULL,
    commentaireApres VARCHAR(50), -- peut être nul si la soutenance n'a pas encore eu lieu
    note INT(11), -- idem
    PRIMARY KEY (id),
	  FOREIGN KEY (idProf) REFERENCES professeur (idProf)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO creneau (idProf,dateDebut,duree,exclusivite,datePublic,libre,commentaireAvant,aEuLieu,commentaireApres,note)
VALUES ('0','1516477347','135','true','1503254547','true','Apporter des stylos',false,NULL,NULL);
