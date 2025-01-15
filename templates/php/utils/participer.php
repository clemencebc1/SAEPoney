<?php session_start();
require_once('../autoloader.php');
Autoloader::register();
use utils\DBConnector;
$connexion = new DBConnector('DBbocquet', 'bocquet', 'bocquet');
$raws_events = $connexion->get_seances_for_user($_SESSION['user']['username']);

$idpo = $connexion->poney_libre($_POST["IDSEANCE"]);
try {
    $connexion->insert_seance($idpo, $_POST['IDSEANCE'], $_POST['NUMCOURS'], $_SESSION['user']['iduser']);
}
catch (Exception $e){
    $_SESSION['Exception'] = $e->getMessage();
}

function redirect($url) {
    header('Location: '.$url);
    die();
}
redirect("../../planning-adherent.php");

?>