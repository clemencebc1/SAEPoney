-- script drop procedure 
DROP TRIGGER IF EXISTS addPersonneCours;
DROP TRIGGER IF EXISTS poids_max_poneys;
-- Verification qu'il n'y a pas plus de 10 personnes dans le cours

CREATE OR REPLACE TRIGGER addPersonneCours BEFORE INSERT ON PARTICIPER FOR EACH ROW
BEGIN 
    DECLARE nbPerCours int DEFAULT 0;
    DECLARE mes VARCHAR(100);
    SELECT COUNT(IDADH) INTO nbPerCours FROM PARTICIPER WHERE NUMCOURS = new.NUMCOURS AND DATEPART = new.DATEPART;
    IF nbPerCours > 9 THEN
        set mes = CONCAT("Impossible d'ajouter ", new.IDADH, ' dans le cours n° ', 
            new.NUMCOURS, "puisque le le nombre maximum d'adherent a été ateint");
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    END IF ;
END |

 


-- les poneys ne peuvent pas supporter plus d'un certain poids

create or replace trigger poids_max_poneys before insert on PARTICIPER for each ROW
BEGIN
    declare poids_poney int;
    declare mes varchar(100);
    declare poids_adherent int;
    select POIDS_MAX into poids_poney from PONEY where IDPO = new.IDPO;
    select POIDS into poids_adherent from PERSONNE natural join ADHERENT where IDADH = new.IDADH;
    if poids_poney < poids_adherent THEN
        set mes = concat(mes, 'Le poney ne peut pas porter plus de ', poids_poney, ' kg');
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |


-- une seance payee ne peut plus passer a false

create or replace trigger paye before update on PARTICIPER for each Row
begin 
    declare paye_s boolean;
    declare mess varchar(50) default "seance deja payee";
    select PAYE into paye_s from PARTICIPER where NUMCOURS = new.NUMCOURS and IDSEANCE = new.IDSEANCE and DATEPART = new.DATEPART and IDADH = new.IDADH;
    if paye_s THEN
            signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |

-- un poney doit avoir au minimm 1 heure de repos entre 2 heures de cours

create or replace trigger repos before insert on PARTICIPER for each Row
begin
    declare mes varchar(50) default "le poney a besoin de repos";
    declare duree_c int default 0;
    select DUREE into duree_c from PARTICIPER natural join SEANCE natural join PONEY where HOUR(DATEPART) = HOUR(new.DATEPART)-2 and DAY(DATEPART) = DAY(new.DATEPART) and MONTH(DATEPART) = MONTH(new.DATEPART) and YEAR(DATEPART) = YEAR(new.DATEPART) and IDPO = new.IDPO;
    if duree_c>=2 THEN
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |

-- On veut la duree d'une seance qui serait le meme jour, meme mois, meme annee,
-- deux heures avant dont la duree est de 2 heures avec le meme poney
