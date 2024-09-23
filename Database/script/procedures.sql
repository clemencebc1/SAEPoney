-- script drop procedure 
DROP TRIGGER IF EXISTS addPersonneCours;
-- Verification qu'il n'y a pas plus de 1. personne dans le cours
delimiter |
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
DELIMITER ;
    