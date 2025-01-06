<!DOCTYPE html>
<html lang="fr">
<?php include 'global/head.php'; 
title_html('Nos Tarifs');
link_to_css('static/tarifs.css');
?>
<script>
    
    function displayMonthly() {
        var monthly = document.getElementById('card-grid-monthly');
        var yearly = document.getElementById('card-grid-yearly');

        if (!monthly.classList.contains('visible')) {
            monthly.classList.add('visible');
            yearly.classList.remove('visible');
        }
        

    }

    function displayYearly() {
        var monthly = document.getElementById('card-grid-monthly');
        var yearly = document.getElementById('card-grid-yearly');

        if (!yearly.classList.contains('visible')) {
            yearly.classList.add('visible');
            monthly.classList.remove('visible');
      }
    }




</script>
<body>
    <?php include('global/header.php') ?>
    <main>
        <section id="prices-container">
            <h1>Nos Tarifs</h1>
            <div class="toggle-buttons">
                <button onclick="displayYearly()" class="toggle active">Annuels</button>
                <button onclick="displayMonthly()" class="toggle">Trimestriels</button>
            </div>
            <div id="card-grid-yearly">
                <div class="card dark">
                    <h2>Cotisation Annuelle + Licence fédérale</h2>
                    <p class="price">111€<span>/an</span></p>
                </div>
                <img scr="img/plus.png" alt="plus">
                <div class="card light">
                    <h2>Forfait Annuel</h2>
                    <p class="price">535€<span>/an</span> ou 54.50€<span>/mois</span></p>
                </div>
            </div>
            <div id="card-grid-monthly">
                <div class="card dark">
                <h2>Cotisation Annuelle + Licence fédérale</h2>
                    <p class="price">111€<span>/an</span></p>
                </div>
                <img scr="img/plus.png" alt="plus">
                <div class="card light">
                    <h2>Forfait Trimestriel</h2>
                    <p class="price">220€<span>/trimestre</span></p>
                </div>
                 
</main>
<?php include('global/footer.php') ?>
</body>
</html>
