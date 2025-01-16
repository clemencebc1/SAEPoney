<!DOCTYPE html>
<html lang="fr">
<?php require_once('php/utils/constantes.php');
include('global/head.php'); 
title_html('Poneys');
link_to_css('static/notconnected/poneys.css');
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
                <h3><?php echo $poney["NOMPO"]?></h3>
                <p><?php echo $poney["DESCRIPTION"]?></p>
            </div>
            <?php } ?>
        </section>
    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>
