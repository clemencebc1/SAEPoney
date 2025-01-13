<?php
session_start();
require_once('../autoloader.php');
Autoloader::register();
use utils\DBConnector;
$connexion = new DBConnector('DBbocquet', 'bocquet', 'bocquet');
$raws_events = $connexion->get_cours_for_moniteur($_SESSION['user']['username']);


header('Content-Type: application/json');

function to_fullcalendar($events){
    foreach ($events as &$data) {
        if (isset($data['DESCRIPTIF'])) {
            $data['title'] = $data['DESCRIPTIF'];
            unset($data['DESCRIPTIF']);       
        }
        if (isset($data['DATEENC'])) {
            $data['start'] = $data['DATEENC'];
            unset($data['DATEENC']);       
        }
    }
    return $events;
}
$events = to_fullcalendar($raws_events);
echo json_encode($events);

?>