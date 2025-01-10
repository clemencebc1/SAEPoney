<?php
class Autoloader {
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
        $class = str_replace('\\', '/', $class);
        // $file = __DIR__ . '/../' . $class . '.php'; // pour que ca marche dans le dossier scr ou templates
        $file = __DIR__ .'/' . $class . '.php'; // pour que ca marche dans le dossier scr ou templates
        if (file_exists($file)) {
            // echo $file;
            require $file;
        } else {
            throw new Exception("Failed opening required '$file'"); //debug au cas ou l autoload ne fonctionne pas
        }
    }
}
?>