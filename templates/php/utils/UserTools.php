<?php
namespace utils;
use utils\DBConnector;
use \PDO;
// classe donnant des outils pour la gestion des utilisateurs
//connexion / deconnexion / verification de connexion
class UserTools {
    
    private static function checkDB($username, $password) {
        $db = new PDO('mysql:host=servinfo-maria;dbname=DBbocquet', 'bocquet', 'bocquet');
        // $db = new PDO('mysql:host=localhost;dbname=SAEPONEY', 'nathan', 'Nath2005');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $hash = hash('sha1', $password);
        $query = $db->prepare('SELECT * FROM USER WHERE MAIL = :username AND PASSWORD = :password');
        $query->execute(array('username' => $username, 'password' => $hash));
        $result = $query->fetch();
        return $result;
    }

    public static function login($username, $password) {
        $user = self::checkDB($username, $password);
        $status = false;
        if ($user) {
            $_SESSION['user'] = array('username' => $user['MAIL'], 'token' => self::generateToken(), 'role' => $user['ROLE']);
            $status = true;
        }
        return $status;
    }
 
    public static function generateToken() {
        $token = bin2hex(random_bytes(32));
        setcookie('token', $token, time() + 3600);
        return $token;
    }

    public static function checkTokenValidity($token) {
        $validity = true;
        if (isempty($_COOKIE['token'])) {
            $validity = false;
        }else if ($token !== $_COOKIE['token']) {
            $validity = false;
        }
        return $validity;
    }

    public static function logout() {
        unset($_SESSION['user']);
    }

    public static function isLogged() {
        return isset($_SESSION['user']);
    }

    public static function requireLogin() {
        if (!self::isLogged()) {
            header('Location: connexion.php');
            exit();
        }
    }

    public static function getUserToken() {
        return $_SESSION['user']['token'];
    }

    public static function getUserRole() {
        return $_SESSION['user']['role'];
    }

    public static function isAdmin() {
        return self::getUserRole() === 'ADMIN';
    }
    public static function isAdherent() {
        return self::getUserRole() === 'ADHERENT';
    }
    public static function isMoniteur() {
        return self::getUserRole() === 'MONITEUR';
    }
}
?>