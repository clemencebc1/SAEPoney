<!DOCTYPE html>
<html lang="fr">
<?php require_once('../constantes/constantes.php');
include('global/head.php'); 
title_html('Poneys');
link_to_css('static/poneys.css');
$poneys = $connexion->get_poneys();?>
<body>
    <?php include('global/header.php'); ?>
    <main>
        <section class="banner">
            <h1>Présentation de nos poneys</h1>
        </section>
    
        <section class="poney-grid">
            <?php foreach($poneys as $poney){
                ?>
            <div class="poney-card">
                <div class="poney-image"></div>
                <h3><?php echo $poney["NOMPO"];?></h3>
                <p>Jeune poney né en <?php echo $poney["DDNPO"]; ?>, ce <?php echo $poney["RACE"]; ?> déborde d'énergie, d'amour et de joie de vivre.<br>Adapté pour les - <?php echo $poney["POIDS_MAX"] ?>kg.</p>
            </div>
            <div class="poney-card">
                <div class="poney-image"></div>
                <h3>Patrick</h3>
                <p>Né en 2017, ce Shetland est adapté au personne de moins de 51kg.</p>
            </div>
            <div class="poney-card">
                <div class="poney-image"></div>
                <h3>Tituan</h3>
                <p>Vétéran du club de 7 ans, ce Fjord est passionné par son travail et sera ravi de vous embarquer sur son dos.<br>Adapté pour les -45kg.</p>
            </div>
            <?php } ?>
        </section>
    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>
