
-- script de creation de la base de donnees

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
                        NUMCOURS INT,
                        PRIX DECIMAL(5,2),
                        DUREE DECIMAL(3,2) CHECK (DUREE BETWEEN 1 AND 2), -- le cours dure entre une et deux heures
                        NIVEAU INT,
                        DESCRIPTIF VARCHAR(50),
                        GROUPE_AGE VARCHAR(50),
                        DATE_SEANCE DATETIME,
                        PRIMARY KEY (IDSEANCE, NUMCOURS)

);

CREATE TABLE PERSONNE(
                         IDPER INT PRIMARY KEY,
                         NOMPER VARCHAR(42),
                         PRENOMPER VARCHAR(42),
                         EMAIL VARCHAR(50) UNIQUE,
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

-- un moniteur encadre une seance a une certaine date
CREATE TABLE ENCADRER(
                         IDMON INT,
                         NUMCOURS INT,
                         IDSEANCE INT,
                         DATEENC DATETIME,
                         PRIMARY KEY (IDMON, NUMCOURS, DATEENC, IDSEANCE)
);

-- un adherent et un poney participe a une seance a une certaine date
CREATE TABLE PARTICIPER(
                           NUMCOURS INT,
                           IDPO int,
                           IDADH INT,
                           PAYE BOOLEAN NOT NULL, -- une fois paye, la seance ne peut pas etre remboursee
                           IDSEANCE INT,
                           PRIMARY KEY (NUMCOURS, IDADH, IDSEANCE, IDPO)
);

-- pour chaque facture, un/des tarif.s sont associes
CREATE TABLE ETRE_PRESENT(
                             IDFACTURE INT,
                             IDTARIF INT,
                             PRIMARY KEY (IDFACTURE,IDTARIF)
);

CREATE TABLE USER (
    MAIL VARCHAR(50),
    PASSWORD VARCHAR(75)
);


-- cles etrangeres
ALTER TABLE USER ADD FOREIGN KEY (MAIL) REFERENCES PERSONNE(EMAIL);

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

-- creation procedures
-- Verification qu'il n'y a pas plus de 10 personne dans le cours
delimiter |
CREATE OR REPLACE TRIGGER addPersonneCours BEFORE INSERT ON PARTICIPER FOR EACH ROW
BEGIN
    DECLARE nbPerCours int DEFAULT 0;
    DECLARE mes VARCHAR(100) default "";
    SELECT COUNT(IDADH) INTO nbPerCours FROM PARTICIPER WHERE IDSEANCE= new.IDSEANCE;
    IF nbPerCours > 9 THEN
        set mes = CONCAT("Impossible d'ajouter ", new.IDADH, ' dans le cours n° ',
                         new.NUMCOURS, "puisque le le nombre maximum d'adherent a été ateint");
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    END IF ;
END |
DELIMITER ;


-- les poneys ne peuvent pas supporter plus d'un certain poids
delimiter |
create or replace trigger poids_max_poneys before insert on PARTICIPER for each ROW
BEGIN
    declare poids_poney int default 0;
    declare mess varchar(100) default "";
    declare poids_adherent int default 0;
    select POIDS_MAX into poids_poney from PONEY where IDPO = new.IDPO;
    select POIDS into poids_adherent from PERSONNE inner join ADHERENT ON PERSONNE.IDPER = ADHERENT.IDADH where IDPER = new.IDADH;
    if poids_poney <= poids_adherent THEN
        set mess = concat(mess, 'Le poney ne peut pas porter plus de ', poids_poney, ' kg');
        signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |
delimiter ;
-- on verifie que le poids de l'adherent ne depasse pas celui du poney

-- une seance payee ne peut plus passer a false
delimiter |
create or replace trigger paye before update on PARTICIPER for each Row
begin
    declare paye_s boolean;
    declare mess varchar(50) default "seance deja payee";
    select PAYE into paye_s from PARTICIPER where IDSEANCE = new.IDSEANCE and IDADH = new.IDADH;
    if paye_s THEN
        signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |
delimiter ;
-- on verifie que la participation modifiee n'est pas a true

-- un poney doit avoir au minimm 1 heure de repos apres 2 heures de cours
delimiter |
create or replace trigger repos before insert on PARTICIPER for each Row
begin
    declare duree_c int default 0;
    declare mes varchar(50) default "le poney a besoin de repos";
    declare date_s datetime default curdate();
    select DATE_SEANCE into date_s from SEANCE where IDSEANCE = new.IDSEANCE;
    select DUREE into duree_c from PARTICIPER natural join SEANCE natural join PONEY where IDPO = new.IDPO and HOUR(DATE_SEANCE)=HOUR(date_s)-2 and DAY(DATE_SEANCE) = DAY(date_s) and MONTH(DATE_SEANCE) = MONTH(date_s) and YEAR(DATE_SEANCE) = YEAR(date_s);
    if duree_c>=2 THEN
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |
delimiter ;
-- on verifie qu'il n'y a pas de cours 2 heures avant la seance

-- un cours individuel ne peut avoir d'un seul participant
delimiter |
create or replace trigger cours_particulier before insert on PARTICIPER for each Row
begin
    declare mes varchar(50) default "le cours particulier a deja un participant";
    declare participant int default 0;
    declare type_cours int default 1;
    select count(IDADH) into participant from PARTICIPER where IDSEANCE=new.IDSEANCE;
    select TYPEC into type_cours from SEANCE NATURAL JOIN  COURS where IDSEANCE = new.IDSEANCE;
    if type_cours != 1 and participant > 0 THEN
        signal SQLSTATE '45000' set MESSAGE_TEXT=mes;
    end if;
end |
delimiter ;
-- on verifie si le cours particulier a deja un participant


-- un poney ne peut pas etre monter par plus d'un participant à une seance
delimiter |
create or replace trigger poney_participant before insert on PARTICIPER for each Row
begin
    declare nb_participant int default 0;
    declare mes varchar(150) default "le poney ne peut pas etre monte par plus d'un participant";
    select count(IDADH) into nb_participant from PARTICIPER where IDPO = new.IDPO and IDSEANCE = new.IDSEANCE;
    if nb_participant >= 1 THEN
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |
delimiter ;