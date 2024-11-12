-- script drop procedure 
DROP TRIGGER IF EXISTS addPersonneCours;
DROP TRIGGER IF EXISTS poids_max_poneys;
DROP TRIGGER IF EXISTS paye;
DROP TRIGGER IF EXISTS repos;
-- Verification qu'il n'y a pas plus de 10 personne dans le cours
delimiter |
CREATE OR REPLACE TRIGGER addPersonneCours BEFORE INSERT ON PARTICIPER FOR EACH ROW
BEGIN 
    DECLARE nbPerCours int DEFAULT 0;
    DECLARE mes VARCHAR(100);
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
    declare mess varchar(100);
    declare poids_adherent int default 0;
    select POIDS_MAX into poids_poney from PONEY where IDPO = new.IDPO;
    select POIDS into poids_adherent from PERSONNE inner join ADHERENT ON PERSONNE.IDPER = ADHERENT.IDADH where IDPER = new.IDADH;
    if poids_poney <= poids_adherent THEN
        set mess = concat(mess, 'Le poney ne peut pas porter plus de ', poids_poney, ' kg');
        signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |
delimiter ;

-- une seance payee ne peut plus passer a false
delimiter |
create or replace trigger paye before update on PARTICIPER for each Row
begin 
    declare paye_s boolean;
    declare mess varchar(50) default "seance deja payee";
    select PAYE into paye_s from PARTICIPER where NUMCOURS = new.NUMCOURS and IDSEANCE = new.IDSEANCE and DATEPART = new.DATEPART and IDADH = new.IDADH;
    if paye_s THEN
            signal SQLSTATE '45000' set MESSAGE_TEXT = mess;
    end if;
end |

-- un poney doit avoir au minimm 1 de repos entre chaque cours
delimiter |
create or replace trigger repos before insert on PARTICIPER for each Row
begin
    declare duree_c int default 0;
    declare mes varchar(50) default "le poney a besoin de repos";
    select DUREE into duree_c from PARTICIPER natural join SEANCE natural join PONEY where IDPO = new.IDPO and HOUR(DATEPART)=HOUR(new.DATEPART)-2 and DAY(DATEPART) = DAY(new.DATEPART) and MONTH(DATEPART) = MONTH(new.DATEPART) and YEAR(DATEPART) = YEAR(new.DATEPART);
    if duree_c>=2 THEN
        signal SQLSTATE '45000' set MESSAGE_TEXT = mes;
    end if;
end |

delimiter ;

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

show triggers;

