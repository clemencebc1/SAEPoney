<?php


class Autoloader {
    static function register(){
        spl_autoload_register([__CLASS__, 'autoload']);
    
    }    
    public static function autoload($fqcn) {
        $path = str_replace('\\', '/', $fqcn) . '.php';
        $basePath = __DIR__ . '/';
        $file = $basePath . $path;
        var_dump($file);
        require $file;
            }
}
Autoloader::register();
?>