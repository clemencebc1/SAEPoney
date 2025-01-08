<?php
require_once 'php/autoloader.php'; 
Autoloader::register();
use utils\DBConnector;
$connexion = new DBConnector('DBbocquet', 'bocquet', 'bocquet');
?>