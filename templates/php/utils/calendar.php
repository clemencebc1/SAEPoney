<?php
require_once("../constantes/constantes.php");

$events = $connexion->get_seances();

header('Content-Type: application/json');
echo json_encode($events);
?>
