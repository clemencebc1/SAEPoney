<?php
session_start();
// classe donnant des outils pour la gestion des utilisateurs
//connexion / deconnexion / verification de connexion
class UserTools {
    // private static function checkDB($username, $password) {
    //     $db = new PDO('mysql:host=localhost;dbname=php', 'root', '');
    //     $query = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
    //     $query->execute(array('username' => $username, 'password' => $password));
    //     $result = $query->fetch();
    //     return $result;
    // }

    public static function login($username, $password) {
        if ($username === 'admin@admin.fr' && $password === 'admin') {
            $_SESSION['user'] = array('username' => $username, 'token' => self::generateToken(), 'role' => 'admin');
            return true;
        } else if ($username === 'user' && $password === 'user') {
            $_SESSION['user'] = array('username' => $username, 'token' => self::generateToken(), 'role' => 'user');
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
            header('Location: login.php');
            exit();
        }
    }

    public static function getUserToken() {
        return $_SESSION['user']['token'];
    }
}
?>