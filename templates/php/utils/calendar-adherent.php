<?php
session_start();
require_once('../autoloader.php');
Autoloader::register();
use utils\DBConnector;
$connexion = new DBConnector('DBbocquet', 'bocquet', 'bocquet');
$raws_events = $connexion->get_seances_for_user($_SESSION['user']['username']);

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
        $data['backgroundColor']='blue';
        $data['type']="my";
    }
    return $events;
}
$events = to_fullcalendar($raws_events);
echo json_encode($events);

?>
