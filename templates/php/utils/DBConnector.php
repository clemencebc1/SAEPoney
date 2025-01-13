<?php
declare(strict_types=1);
namespace utils;
use \PDO;

class DBConnector {
    private $pdo;
    public function __construct($nombase, $dbuser, $dbpass){
        // $this->pdo= new PDO('mysql:host=servinfo-maria;dbname='.$nombase.'', $dbuser, $dbpass);
        $this->pdo= new PDO('mysql:host=localhost;dbname='.$nombase, $dbuser, $dbpass);
    }
    
    /**
     * get_user, verifie un utilisateur dans la base de données 
     * en fonction de l'identifiant et du mot de passe
     *
     * @param  string $mail
     * @param  string $password
     * @return bool true si l'utilisateur a saisi le bon mot de passe
     */
    public function get_user(string $mail, string $password):bool{
        $sql = "SELECT * FROM USER WHERE MAIL = ? AND PASSWORD = SHA1(?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$mail, $password]);
        $user = $stmt->fetch();
        if ($user == NULL){
            return false;
        }
        return true;

    }    
    /**
     * get_poneys, get l'ensemble des poneys dans la base de données
     *
     * @return array ensemble des poneys
     */
    public function get_poneys(): array{
        $sql = "SELECT * FROM PONEY;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }    
    /**
     * get_cours, get l'ensemble des cours dans la base de données
     *
     * @return array ensemble des cours 
     */
    public function get_cours(): array{
        $sql = "SELECT * FROM COURS;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public function get_seances_for_user(string $user){
        $sql = "SELECT DISTINCT DESCRIPTIF, DATE_SEANCE FROM SEANCE NATURAL JOIN PARTICIPER NATURAL JOIN ADHERENT NATURAL JOIN PERSONNE WHERE EMAIL='in@icloud.org' AND IDADH=IDPER;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }


    /**
     * get_seances, get l'ensemble des seances dans la base de donnees
     *
     * @return array ensemble des seances
     */
    public function get_seances():array{
        $sql = "SELECT * FROM SEANCE;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    /**
     * get_personnes, get l'ensemble des personnes dans la base de donnees
     *
     * @return array ensemble de personnes
     */
    public function get_personnes():array{
        $sql = "SELECT * FROM PERSONNE;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        $rows;
    }
        
    /**
     * get_moniteurs, get l'ensemble des moniteurs de la base de donnees
     *
     * @return array ensemble des moniteurs
     */
    public function get_moniteurs():array{
        $sql = "SELECT * FROM MONITEUR;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        $rows;
    }    
    /**
     * get_adherents, get l'ensemble des adherents dans la base de données
     *
     * @return array ensemble des adherents
     */
    public function get_adherents():array{
        $sql = "SELECT * FROM ADHERENT;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        $rows;
    }    
    /**
     * get_factures, get l'ensemble des factures de la base de donnes
     *
     * @return array ensemble des factures
     */
    public function get_factures():array{
        $sql = "SELECT * FROM FACTURE;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }    

/**
     * get_factures, get factures user 
     *
     * @return array ensemble des factures d'un utilisateur
     */
    public function get_factures_user(string $user){
        $user = "in@icloud.org";
        $sql = "SELECT DATEEDITION, PAYE, TOTALTTC, DESCRIPTIF FROM FACTURE NATURAL JOIN PERSONNE NATURAL JOIN PARTICIPER NATURAL JOIN SEANCE WHERE IDADH=IDPER AND EMAIL='". $user ."'";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    /**
     * get_tarifs, get l'ensemble des tarifs de la base de donnees
     *
     * @return array ensemble des tarifs
     */
    public function get_tarifs():array{
        $sql = "SELECT * FROM TARIFS;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function get_encadrer_moniteur(int $idmon): void {
        $sql = "SELECT IDSEANCE FROM ENCADRER WHERE IDMON = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idmon]);
        $user = $stmt->fetchAll();

    }

    public function get_next_id_personne(): int {
        $sql = "SELECT MAX(IDPER) FROM PERSONNE";
        $stmt = $this->pdo->query($sql);
        $id = $stmt->fetch();
        return $id[0] + 1;
    }


    public function insertion_personne(int $id ,string $nom, string $prenom, string $email, string $date_naissance, string $poids, string $adresse,string $tel): void {
        $sql = "INSERT INTO PERSONNE (IDPER, NOMPER, PRENOMPER, EMAIL, DDNPER, POIDS, ADRESSE, PORTABLE) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id, $nom, $prenom, $email, $date_naissance, $poids, $adresse, $tel]);
    }

    // public function insertion_adherent(int $idadh, string $date, string $niveau): void {
    //     $sql = "INSERT INTO ADHERENT (IDADH, FINCOTISATION, NIVEAUGALOT) VALUES (:id, STR_TO_DATE(':date', '%d-%m-%Y'), :niveau)";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindparam(':id', $idadh);
    //     $stmt->bindparam(':date', $date);
    //     $stmt->bindparam(':niveau', $niveau);
    //     $stmt->execute();
    // }

    // public function insertion_moniteur(int $idmon, $contract, string $date): void {
    //     $sql = "INSERT INTO MONITEUR (IDMON, TYPECONTRAT, DATEEMBAUCHE) VALUES (:id, :contract, STR_TO_DATE(':date', '%d-%m-%Y'))";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindparam(':id', $idmon);
    //     $stmt->bindparam(':contract', $contract);
    //     $stmt->bindparam(':date', $date);
    //     $stmt->execute();
    // }

    public function insertion_adherent(int $idadh, string $date, string $niveau): void {
        $sql = "INSERT INTO ADHERENT (IDADH, FINCOTISATION, NIVEAUGALOT) VALUES (:id, :date, :niveau)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idadh);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->execute();
    }

    public function insertion_moniteur(int $idmon, $contract, string $date): void {
        $sql = "INSERT INTO MONITEUR (IDMON, TYPECONTRAT, DATEEMBAUCHE) VALUES (:id, :contract, :date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idmon);
        $stmt->bindParam(':contract', $contract);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
    }

}
?>