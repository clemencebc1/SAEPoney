<?php
session_start();
require_once 'php/autoloader.php';
Autoloader::register();
use utils\UserTools;
use components\ActionForm;
use utils\DBConnector;
UserTools::requireLogin();
?>

<!DOCTYPE html>
<html lang="fr">
    <?php require_once('php/utils/constantes.php');
    include 'global/head.php'; 
    title_html('Administrateur home');
    link_to_css('static/accueil_2.css'); 
    link_to_css('static/administrator_control_pannel.css');?>
<body>
    <?php include('global/header_connected.php');  ?>

    <main>
        <section class="action-bar">
            <nav>
                <ul>
                    <li><a href="?action=registerAdherent">Inscrire Adherant</a></li>
                    <li><a href="?action=registerMoniteur">Inscrire Moniteur</a></li>
                    <li><a href="?action=registerCours">Inscrire Cours</a></li>
                    <li><a href="?action=registerPoney">Inscrire Poney</a></li>
                    <li><a href="?action=registerSeance">Inscrire Seance</a></li>
                    <li><a href="?action=registerUser">Inscrire User</a></li>
                </ul>
            </nav>
        </section>
        <section class="actions">
            <?php
            $type = isset($_GET['action']) ? $_GET['action'] : 'default';
            $actionForm = new ActionForm($type);
            var_dump($actionForm);
            echo $actionForm->render();
            if (isset($_GET['action']) && isset($_GET['submit'] )? $_GET['submit'] : false ) {
                echo "<color style='color: green;'>Formulaire envoyé</color>";
                echo "<pre>" . print_r($_POST, true) . "</pre>";
            }
            ?>
        </section>
    </main>
    <?php include('global/footer.php') ?>
</body>
</html>

<?php

if (isset($_GET['action']) && isset($_GET['submit'] )? $_GET['submit'] : false ) {
    $db = new DBConnector('SAEPONEY', 'nathan', 'Nath2005');
    switch ($_GET['action']) {
        case 'registerAdherent':
            $nextId = $db->get_next_id_personne();
            $db -> insertion_personne($nextId, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['date_naissance'], $_POST['poids'], $_POST['adresse'], $_POST['tel']);
            $db -> insertion_adherent($nextId, $_POST['fincotisation'], $_POST['niveau']);
            echo "<color style='color: g    reen;'>Ajout dans BD</color>";
            break;
        case 'registerMoniteur':
            $db = DBConnector::getDatabase();
            $db->insertMoniteur($_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['date_naissance']);
            break;
        case 'registerCours':
            $db = DBConnector::getDatabase();
            $db->insertCours($_POST['nom'], $_POST['description'], $_POST['moniteur_id']);
            break;
        case 'registerPoney':
            $db = DBConnector::getDatabase();
            $db->insertPoney($_POST['nom'], $_POST['taille'], $_POST['poids']);
            break;
        case 'registerSeance':
            $db = DBConnector::getDatabase();
            $db->insertSeance($_POST['date'], $_POST['cours_id'], $_POST['moniteur_id']);
            break;
        case 'registerUser':
            $db = DBConnector::getDatabase();
            $db->insertUser($_POST['email'], $_POST['password'], $_POST['role']);
            break;
        default:
            break;
    }
}
?>
