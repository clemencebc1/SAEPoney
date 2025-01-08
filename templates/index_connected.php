<?php
require_once 'php/autoloader.php';
Autoloader::register();
use utils\UserTools;
UserTools::requireLogin();
?>

<!DOCTYPE html>
<html lang="fr">
    <?php require_once('php/utils/constantes.php');
    include 'global/head.php'; 
    title_html('Connected');
    link_to_css('static/accueil_2.css'); ?>
<body>
    <?php include('global/header_connected.php');  ?>

    <main>
        <section class="next-cours">
            <button class="left">&lt;</button>
            <div class="next-cours-info">
                <p class="cours-date">
                    <?php $cours_user = $connexion->get_seance_for_user('in@icloud.org'); 
                        $compteur = 0;
                    ?>
                     Votre prochain cours a lieu le <strong><?php echo $cours_user[$compteur] ?></strong></p>
                <p class="cours-details"><?php echo $cours_user[1] ?></p>
                <button class="btn-voir-cours">Voir tous mes cours</button>
            </div>
            <button class="right">&gt;</button>
        </section>
        <section class="block-facture">
            <div id="info">
                <div class="clock-icon">
                    <img src="clock-icon.png" alt="Clock">
                </div>
                <p id="days">3 jours</p>
                <p id="days-description">Facture à payer</p>
            </div>
        </section>
    </main>
    <?php include('global/footer.php') ?>
</body>
</html>
