<?php
namespace utils;
use utils\DBConnector;
use \PDO;
session_start();
// classe donnant des outils pour la gestion des utilisateurs
//connexion / deconnexion / verification de connexion
class UserTools {
    
    private static function checkDB($username, $password) {
        $db = new PDO('mysql:host=servinfo-maria;dbname=DBrandriantsoa', 'randriantsoa', 'randriantsoa');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $hash = hash('sha1', $password);
        $query = $db->prepare('SELECT * FROM USER WHERE MAIL = :username AND PASSWORD = :password');
        $query->execute(array('username' => $username, 'password' => $hash));
        $result = $query->fetch();
        return $result;
    }

    public static function login($username, $password) {
        $user = self::checkDB($username, $password);
        if ($user) {
            $_SESSION['user'] = array('username' => $user['MAIL'], 'token' => self::generateToken(), 'role' => $user['ROLE']);
            return true;
        }
        return false;
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
            header('Location: index.php');
            exit();
        }
    }

    public static function getUserToken() {
        return $_SESSION['user']['token'];
    }
}
?>