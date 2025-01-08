<?php
declare(strict_types=1);
namespace utils;
use \PDO;
class DBConnector {
    private $pdo;
    public function __construct($nombase, $dbuser, $dbpass){
        $this->pdo= new PDO('mysql:host=servinfo-maria;dbname='.$nombase.'', $dbuser, $dbpass);
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["NUMCOURS"], $array["NOMCOURS"], $array["TYPEC"]);
            array_push($allinfo, $info);
        }
        return $info;
    }
    
    public function get_seance_for_user(string $user){
        $sql = "SELECT DISTINCT DESCRIPTIF, DATE_SEANCE FROM SEANCE NATURAL JOIN PARTICIPER NATURAL JOIN ADHERENT NATURAL JOIN PERSONNE WHERE EMAIL='in@icloud.org' AND IDADH=IDPER;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["DATE_SEANCE"], $array["DESCRIPTIF"]);
            array_push($allinfo, $info);
        }
        return $info;
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["IDSEANCE"], $array["NUMCOURS"], $array["PRIX"], $array["DUREE"], $array["NIVEAU"], $array["DESCRIPTIF"], $array["GROUPE_AGE"], $array["DATE_SEANCE"]);
            array_push($allinfo, $info);
        }
        return $info;
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["IDPER"], $array["NOMPER"], $array["PRENOMPER"], $array["EMAIL"], $array["DDNPER"], $array["POIDS"], $array["ADRESSE"], $array["PORTABLE"]);
            array_push($allinfo, $info);
        }
        return $info;
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["IDMON"], $array["TYPECONTRAT"], $array["DATEEMBAUCHE"]);
            array_push($allinfo, $info);
        }
        return $info;
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["IDADH"], $array["FINCOTISATION"], $array["NIVEAUGALOT"]);
            array_push($allinfo, $info);
        }
        return $info;
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["IDFACTURE"], $array["TOTALTTC"], $array["DATEEDITION"], $array["IDADH"]);
            array_push($allinfo, $info);
        }
        return $info;
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
        $allinfo = array();
        foreach($rows as $array){
            $info = array($array["IDTARIF"], $array["ANNEE"], $array["PRIX"]);
            array_push($allinfo, $info);
        }
        return $info;
    }
    public function get_encadrer_moniteur(int $idmon): void {
        $sql = "SELECT IDSEANCE FROM ENCADRER WHERE IDMON = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idmon]);
        $user = $stmt->fetchAll();

    }


}
?>