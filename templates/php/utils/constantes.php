<?php
try { require_once 'php/autoloader.php'; }
catch (Exception $e){
    require_once '../constantes.php';
}


Autoloader::register();
use utils\DBConnector;
$connexion = new DBConnector('DBbocquet', 'bocquet', 'bocquet');
//$connexion = new DBConnector('DBrandriantsoa', 'randriantsoa', 'randriantsoa');
// $connexion = new DBConnector('SAEPONEY', 'nathan', 'Nath2005');

?>