-- create new schema
create database if not exists SAE_PONNEY;

-- Script de création de la base de données SAE Poney
DROP TABLE IF EXISTS ENCADRER;
DROP TABLE IF EXISTS ETRE_PRESENT;
DROP TABLE IF EXISTS TARIFS;
DROP TABLE IF EXISTS FACTURE;
DROP TABLE IF EXISTS SOLLICITER;
DROP TABLE IF EXISTS PARTICIPER;
DROP TABLE IF EXISTS PONEY;
DROP TABLE IF EXISTS SEANCE;
DROP TABLE IF EXISTS COURS;
DROP TABLE IF EXISTS ADHERENT;
DROP TABLE IF EXISTS MONITEUR;
DROP TABLE IF EXISTS PERSONNE;



CREATE TABLE PONEY(
    IDPO INT PRIMARY KEY AUTO_INCREMENT, 
    NOMPO VARCHAR(15),
    DDNPO DATE,
    POIDS_MAX INT(3) NOT NULL, -- un poney supporte un poids max 
    RACE VARCHAR(20),
    SEXE enum('F', 'M')
);

CREATE TABLE COURS (
    NUMCOURS INT PRIMARY KEY,
    NOMCOURS VARCHAR(42),
    TYPEC enum('Collectif', 'Individuel')
);

CREATE TABLE SEANCE (
    IDSEANCE INT,
    PRIX DECIMAL(5,2),
    DUREE DECIMAL(3,2) CHECK (DUREE BETWEEN 1 AND 2), -- le cours dure entre une et deux heures
    NIVEAU INT,
    DESCRIPTIF VARCHAR(50),
    GROUPE_AGE VARCHAR(50),
    NUMCOURS INT,
    DATE_SEANCE DATETIME,
    PRIMARY KEY (IDSEANCE, NUMCOURS)

);

CREATE TABLE PERSONNE(
    IDPER INT PRIMARY KEY,
    NOMPER VARCHAR(42),
    PRENOMPER VARCHAR(42),
    EMAIL VARCHAR(50),
    DDNPER DATE,
    POIDS DECIMAL(5,2),
    ADRESSE VARCHAR(100), 
    PORTABLE VARCHAR(14)

);

CREATE TABLE MONITEUR(
    IDMON INT PRIMARY KEY,
    TYPECONTRAT VARCHAR(42),
    DATEEMBAUCHE DATE
);

CREATE TABLE ADHERENT (
    IDADH INT PRIMARY KEY,
    FINCOTISATION DATE,
    NIVEAUGALOT INT
);

CREATE TABLE FACTURE ( -- correspond au cotisation de l'adherent chaque annee
    IDFACTURE INT PRIMARY KEY auto_increment,
    TOTALTTC DECIMAL(10,2),
    DATEEDITION DATE,
    IDADH INT
);


CREATE TABLE TARIFS (
    IDTARIF INT PRIMARY KEY,
    ANNEE DATE,
    PRIX DECIMAL(7,2)
);

-- associations

-- un moniteur encadre un cours a une date precise
CREATE TABLE ENCADRER(
    IDMON INT,
    NUMCOURS INT,
    IDSEANCE INT,
    DATEENC DATETIME,
    PRIMARY KEY (IDMON, NUMCOURS, DATEENC, IDSEANCE)
);

-- un adherent participe a un cours a une date precise
CREATE TABLE PARTICIPER(
    NUMCOURS INT, 
    IDPO int,
    IDADH INT,
    DATEPART DATETIME,
    PAYE BOOLEAN NOT NULL,
    IDSEANCE INT,
    PRIMARY KEY (NUMCOURS, IDADH, DATEPART, IDSEANCE, IDPO)
);

-- association entre tarifs et facture
CREATE TABLE ETRE_PRESENT(
    IDFACTURE INT,
    IDTARIF INT,
    PRIMARY KEY (IDFACTURE,IDTARIF)
);



-- cles etrangeres
ALTER TABLE MONITEUR ADD FOREIGN KEY (IDMON) REFERENCES PERSONNE(IDPER);
ALTER TABLE ADHERENT ADD FOREIGN KEY (IDADH) REFERENCES PERSONNE(IDPER);

ALTER TABLE FACTURE ADD FOREIGN KEY (IDADH) REFERENCES ADHERENT(IDADH);
ALTER TABLE SEANCE ADD FOREIGN KEY (NUMCOURS) REFERENCES COURS(NUMCOURS);

ALTER TABLE ENCADRER ADD FOREIGN KEY (IDMON) REFERENCES MONITEUR(IDMON);
ALTER TABLE ENCADRER ADD FOREIGN KEY (IDSEANCE, NUMCOURS) REFERENCES SEANCE(IDSEANCE, NUMCOURS);

ALTER TABLE PARTICIPER ADD FOREIGN KEY (IDADH) REFERENCES ADHERENT(IDADH);
ALTER TABLE PARTICIPER ADD FOREIGN KEY (IDPO) REFERENCES PONEY(IDPO);
ALTER TABLE PARTICIPER ADD FOREIGN KEY (IDSEANCE, NUMCOURS) REFERENCES SEANCE(IDSEANCE, NUMCOURS);

ALTER TABLE ETRE_PRESENT ADD FOREIGN KEY (IDFACTURE) REFERENCES FACTURE(IDFACTURE);
ALTER TABLE ETRE_PRESENT ADD FOREIGN KEY (IDTARIF) REFERENCES TARIFS(IDTARIF);
