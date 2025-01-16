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
link_to_css('static/admin/administrator_control_pannel.css');?>
<body>
    <?php include('global/header_connected.php');  ?>
            
    <main>
        <section class="action-bar">
            <nav>
                <ul>
                    <li><a href="?action=registerAdherent">Inscrire Adherant</a></li>
                    <li><a href="?action=registerMoniteur">Inscrire Moniteur</a></li>
                    <li><a href="?action=registerCours">Ajouter un Cours</a></li>
                    <li><a href="?action=registerPoney">Ajouter un Poney</a></li>
                    <li><a href="?action=registerSeance">Ajouter une Seance</a></li>
                    <li><a href="?action=registerUser">Inscrire User</a></li>
                </ul>
            </nav>
        </section>
                    <section class="action">
                        <?php
                        $type = isset($_GET['action']) ? $_GET['action'] : 'default';
                        $actionForm = new ActionForm($type);
                        echo $actionForm->render();
                        if (isset($_GET['action']) && isset($_GET['submit'] )? $_GET['submit'] : false ) {
                            echo "<color style='color: green;'>Formulaire envoyé</color>";

                        }
                        switch (isset($_GET['error']) ? $_GET['error'] : false) {
                            case '1':
                                echo "<color style='color: red;'>Erreur inconnu (Lors de l'insertions des données dans la base)</color>";
                                break;
                            case '2':
                                echo "<color style='color: red;'>Une personne dans la base de données possède cette email</color>";
                                break;
                            case '3':
                                echo "<color style='color: red;'>Les mots de passe ne correspondent pas</color>";
                                break;
                            default:
                                break;
                        }
                        ?>
        </section>
    </main>
<?php include('global/footer.php') ?>
</body>
</html>
            
            <?php
            
            if (isset($_GET['action']) && isset($_GET['submit'] )? $_GET['submit'] : false ) {
                $db = new DBConnector('DBbocquet', 'bocquet', 'bocquet');
                switch ($_GET['action']) {
                    case 'registerAdherent':
                        $nextId = $db->get_next_id_personne();
                        $db -> insertion_personne($nextId, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['date_naissance'], $_POST['poids'], $_POST['adresse'], $_POST['tel']);
                        $db -> insertion_adherent($nextId, $_POST['fincotisation'], $_POST['niveau']);
                        echo "<color style='color: green;'>Ajout dans BD</color>";
                        break;
                    case 'registerMoniteur':
                        $nextId = $db->get_next_id_personne();
                        $db -> insertion_personne($nextId, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['date_naissance'], $_POST['poids'], $_POST['adresse'], $_POST['tel']);
                        $db -> insertion_moniteur($nextId, $_POST['typecontrat'], $_POST['dateembauche']);
                        break;
                    case 'registerCours':
                        $nextId = $db->get_next_numcours();
                        $db->insertion_cours($nextId, $_POST['cours'], $_POST['typec']);
                        break;
                    case 'registerPoney':
                        echo "<color style='color: green;'>Not yet implemented</color>";
                        break;
                    case 'registerSeance':
                        echo "<color style='color: green;'>Not yet implemented</color>";
                        break;
                    case 'registerUser':
                        var_dump($_POST);
                        $password = $_POST['password'];
                        $confirmPassword = $_POST['confirmPassword'];
                        $passCheck = ($password === $confirmPassword);
                        try {
                            if ($passCheck) {
                                echo "<color style='color: green;'>mot de pass identique (debug condition)</color>";
                                $hash = hash('sha1', $password);
                                $db->insert_user($_POST['email'], $hash, $_POST['role']);
                            } else {
                                header('Location: administrator_control_pannel.php?error=3');
                            }
                        }catch (Exception $e) {
                            if ($e->getCode() === 23000) {
                                header('Location: administrator_control_pannel.php?error=2');
                            } else {
                                header('Location: administrator_control_pannel.php?error=1');
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
?>