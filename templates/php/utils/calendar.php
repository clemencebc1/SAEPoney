<?php
require_once('../autoloader.php');
Autoloader::register();
use utils\DBConnector;
$connexion = new DBConnector('SAEPONEY', 'nathan', 'Nath2005');
$raws_events = $connexion->get_seances();

header('Content-Type: application/json');

function to_fullcalendar($events){
    foreach ($events as &$data) {
        if (isset($data['DESCRIPTIF'])) {
            $data['title'] = $data['DESCRIPTIF'];
            unset($data['DESCRIPTIF']);       
        }
        if (isset($data['DATE_SEANCE'])) {
            $data['start'] = $data['DATE_SEANCE'];
            unset($data['DATE_SEANCE']);       
        }
    }
    return $events;
}

$events = to_fullcalendar($raws_events);
echo json_encode($events);


?>
