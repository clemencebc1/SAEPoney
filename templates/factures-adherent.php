<!DOCTYPE html>
<html lang="fr">
<?php try { require_once('../constantes/constantes.php');
include('global/head.php'); 
title_html('Factures adhérent');
link_to_css('static/factures.css');
$factures = $connexion->get_seances_for_user("in@cloud.org");
}
catch (Exception $e) {
    $factures = array(array("PAYE"=>true, "DESCRIPTIF"=>"groom", "DATEEDITION"=>"2024-12" ), array("PAYE"=>false, "DESCRIPTIF"=>"groom2", "DATEEDITION"=>"2024-12" ));
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
                <?php if($facture["PAYE"]){
                    echo "&#x1F6A8;";
                    echo "<style> border-left: 5px solid #2ecc71;</style>";
                }
                else {
                    echo "&#x2705;";
                    echo "<style> border-left: 5px solid #e74c3c;</style>";

                }
                echo "<h3>Facture du " . $facture["DATEEDITION"] . "</h3>";
                ?>
            </div>
            <div><?php echo "Facture du cours" . $facture["DESCRIPTIF"] . " - " .  $facture["DATEEDITION"] ?>
            <?php if ($facture["PAYE"]){ echo "<br>Vous possédez d'un délai de deux semaines pour régler votre facture. Il vous reste 8 jours.</p>" ; } }?>
        </div>
    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>