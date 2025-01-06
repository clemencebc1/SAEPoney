<!DOCTYPE html>
<html lang="fr">
<?php include 'global/head.php'; 
require_once 'php/utils/UserTools.php';
####################################################################################################
if (UserTools::isLogged()) {
    print_r(var_dump($_SESSION['user']));
}
####################################################################################################
title_html('Poney Club');
link_to_css('static/accueil.css'); ?>

<body>
    <?php include('global/header.php');  ?>
    <main>
        <div class="poney">img here</div>
        <div class="content">
            <div class="box-img"><img src="img/poney-2.jpg" alt="Photo de poney libre de droits"></div>
            <div class="box">Grand Galop, un poney club de Sologne et adhérente à la Fédération Française de l'équitation, a le plaisir le vous accueillir dans nos centres équestres. Nous vous proposons de découvrir nos poneys, notre planning d'activité et l'avis de nos adhérents. </div>
            <div class="box deuxieme-ligne">Plus d'informations</div>
        </div>
    </main>
    <?php include('global/footer.php') ?>
</body>
</html>
