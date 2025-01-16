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
        <?php $autres_factures = array();
        foreach($factures as $facture){
            if (!in_array($facture['IDFACTURE'], $autres_factures)){
                $autres_factures[$facture['IDFACTURE']] = array($facture['DESCRIPTIF'], $facture['DATEEDITION'], $facture['PAYE']);}
        }
        foreach($autres_factures as $facture){
                ?>
        <div class="bloc">
            <div class="facture-header">
                <?php
                if($facture[2]==0){
                    echo "&#x1F6A8;";
                    echo "<style> border-left: 5px solid #2ecc71;</style>";
                }
                else {
                    echo "&#x2705;";
                    echo "<style> border-left: 5px solid #e74c3c;</style>";

                }
                echo "<h3> Facture du " . $facture[1] . "</h3>";
                ?>
            </div>
            <div><?php echo "Facture du cours " . $facture[0] . " - " .  $facture[1]; ?>
            <?php if ($facture[2]==0){ echo "<br>Vous possédez d'un délai de deux semaines pour régler votre facture. Il vous reste 8 jours.</p>" ; } ?>
        </div> </div> 
        <?php } ?>
    </div>
    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>