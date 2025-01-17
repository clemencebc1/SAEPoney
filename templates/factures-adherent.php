<!DOCTYPE html>
<html lang="fr">
<?php 
session_start();
require_once('php/autoloader.php');
Autoloader::register(); 
use utils\UserTools;
UserTools::requireLogin();
try { require_once('php/utils/constantes.php');
include('global/head.php'); 
title_html('Factures adhérent');
link_to_css('static/factures.css');
$factures = $connexion->get_factures_user($_SESSION['user']['username']);
}
catch (Exception $e) {
    $factures = array();
}
?>
<body>
    <?php include('global/header_connected.php'); ?>
    <main></main>
    <div class="container">
        <h1>Vos factures</h1>
        <?php foreach($factures as $facture){
                ?>
        <div class="bloc">
            <div class="facture-header">
                <?php
                if($facture["PAYE"]==0){
                    echo "&#x1F6A8;";
                    echo "<style> border-left: 5px solid #2ecc71;</style>";
                }
                else {
                    echo "&#x2705;";
                    echo "<style> border-left: 5px solid #e74c3c;</style>";

                }
                echo "<h3> Facture du " . $facture["DATEEDITION"] . "</h3>";
                ?>
            </div>
            <div><?php echo "Facture du cours " . $facture["DESCRIPTIF"] . " - " .  $facture["DATEEDITION"]; ?>
            <?php if ($facture["PAYE"]==0){ echo "<br>Vous possédez d'un délai de deux semaines pour régler votre facture. Il vous reste 8 jours.</p>" ; } ?>
        </div> </div> 
        <?php } ?>
    </div>
    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>