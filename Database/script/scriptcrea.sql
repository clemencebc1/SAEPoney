
-- Script de création de la base de données SAE Poney
DROP TABLE IF EXISTS ENCADRER;
DROP TABLE IF EXISTS FACTURE;
DROP TABLE IF EXISTS SOLLICITER;
DROP TABLE IF EXISTS PARTICIPER;
DROP TABLE IF EXISTS PONEY;
DROP TABLE IF EXISTS ADHERENT;
DROP TABLE IF EXISTS MONITEUR;
DROP TABLE IF EXISTS PERSONNE;

CREATE TABLE PONEY(
    IDPO INT PRIMARY KEY AUTO_INCREMENT,
    NOMPO VARCHAR(15),
    DDNPO DATE,
    POIDS_MAX INT(3) NOT NULL,
    RACE VARCHAR(20),
    GENRE VARCHAR(1)
);

CREATE TABLE COURS (
    NUMCOURS INT PRIMARY KEY AUTO_INCREMENT,
    NOMCOURS VARCHAR(42),
    TYPEC VARCHAR(42)
);

CREATE TABLE PERSONNE(
    IDPER INT PRIMARY KEY,
    NOMPER VARCHAR(42),
    PRENOMPER VARCHAR(42),
    EMAIL VARCHAR(50),
    DDNPER DATE,
    POIDS DECIMAL(3,2),
    ADRESSE VARCHAR(100)

);

CREATE TABLE MONITEUR(
    IDMON INT PRIMARY KEY,
    TYPECONTRAT VARCHAR(42),
    DATEEMBAUCHE DATE
);

CREATE TABLE ADHERENT (
    IDADH INT PRIMARY KEY,
    FINCOTISATION DATE
);

CREATE TABLE FACTURE (
    IDFACTURE INT,
    TOTALTTC DECIMAL(10,2),
    DATEEDITION DATE,
    IDADH INT
);

CREATE TABLE SOLLICITER(
    NUMCOURS INT,
    IDPO INT, 
    DATESOL DATE,
    PRIMARY KEY (NUMCOURS, IDPO, DATESOL)
);

CREATE TABLE ENCADRER(
    IDMON INT,
    NUMCOURS INT,
    DATEENC DATE,
    PRIMARY KEY (IDMON, NUMCOURS, DATEENC)
);

CREATE TABLE PARTICIPER(
    NUMCOURS INT, 
    IDADH INT,
    DATEPART DATE,
    PRIMARY KEY (NUMCOURS, IDADH, DATEPART)
);

ALTER TABLE MONITEUR ADD FOREIGN KEY (IDMON) REFERENCES PERSONNE(IDPER);
ALTER TABLE ADHERENT ADD FOREIGN KEY (IDADH) REFERENCES PERSONNE(IDPER);
ALTER TABLE FACTURE ADD FOREIGN KEY (IDAHD) REFERENCES ADHERENT(IDADH);
ALTER TABLE SOLLICITER ADD FOREIGN KEY (IDPO) REFERENCES PONEY(IDPO);
ALTER TABLE SOLLICITER ADD FOREIGN KEY (NUMCOURS) REFERENCES COURS(NUMCOURS);
ALTER TABLE ENCADRER ADD FOREIGN KEY (IDMON) REFERENCES MONITEUR(IDMON);
ALTER TABLE ENCADRER ADD FOREIGN KEY (NUMCOURS) REFERENCES COURS(NUMCOURS);
ALTER TABLE PARTICIPER ADD FOREIGN KEY (IDADH) REFERENCES ADHERENT(IDADH);
ALTER TABLE PARTICIPER ADD FOREIGN KEY (NUMCOURS) REFERENCES COURS(NUMCOURS);

