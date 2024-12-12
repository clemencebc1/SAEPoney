<?php
declare(strict_types=1);
class DBConnector {
    private $pdo;
    public function __construct($nombase, $dbuser, $dbpass){
        $this->pdo= new PDO('mysql:host=servinfo-maria;dbname='.$nombase.'', $dbuser, $dbpass);
    }
    public function get_user(string $mail, string $password){
        $sql = "SELECT * FROM USER WHERE MAIL = ? AND PASSWORD = SHA1(?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$mail, $password]);
        $user = $stmt->fetch();
        if ($user == NULL){
            return false;
        }
        return true;

    }
}

$db = new DBConnector("DBbocquet", 'bocquet', 'bocquet');
$result = $db->get_user("in@icloud.org","LOL123");
var_dump($result);


 
?>