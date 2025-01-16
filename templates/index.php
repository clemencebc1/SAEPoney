<?php
session_start();
require_once 'php/autoloader.php';
Autoloader::register();
use utils\UserTools;
// $_SESSION['test'] = 'true';
if (UserTools::isLogged()) {
    header('Location: index_connected.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php 
// phpinfo();
include 'global/head.php'; 
title_html('Poney Club');
link_to_css('static/notconnected/accueil.css'); ?>

<body>
    <?php include('global/header.php');  ?>
    <h2>Bienvenue chez Grand Galop</h2>
    <main>
        <img src="img/poney-2.jpg" alt="Photo de poney">
        <div class="description">
            <p>
                Grand Galop, un poney club de Sologne et adhérente à la Fédération Française de l'équitation, a le plaisir
                de vous accueillir dans nos centres équestres. Nous vous proposons de découvrir nos poneys, notre planning
                d'activité et l'avis de nos adhérents.
            </p>
        
        </div>
        <div class="description">
            <p> Couple passionée par l'équitation, depuis plusieurs années nous avons réalisé notre rêve : ouvrir un centre équestre.</p>
        </div>
    </main>
    <?php include('global/footer.php') ?>
</body>
</html>
