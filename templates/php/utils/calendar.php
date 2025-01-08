<?php

require_once(__DIR__ . "/../../../constantes/constantes.php");
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
}
$events = to_fullcalendar($raws_events);
echo json_encode($raws_events);

?>
