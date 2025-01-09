<!DOCTYPE html>
<html lang="fr">
<?php include 'global/head.php'; 
title_html('Nos Tarifs');
link_to_css('static/tarifs.css');
?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const toggleButtons = document.querySelectorAll(".toggle-btn");
    const monthlyGrid = document.getElementById("card-grid-monthly");
    const yearlyGrid = document.getElementById("card-grid-yearly");

    // Initialiser la visibilité
    yearlyGrid.classList.add("visible");
    monthlyGrid.style.opacity = "0.5";
    monthlyGrid.classList.remove("visible");

    toggleButtons.forEach((button) => {
        button.addEventListener("click", () => {
            // Supprimer la classe "active" de tous les boutons
            toggleButtons.forEach((btn) => btn.classList.remove("active"));

            // Ajouter la classe "active" au bouton cliqué
            button.classList.add("active");

            // Basculer les grilles en fonction du bouton cliqué
            if (button.textContent.trim() === "Annuels") {
                yearlyGrid.classList.add("visible");
                monthlyGrid.style.opacity = "0.5";
                yearlyGrid.style.opacity = "1";
                monthlyGrid.classList.remove("visible");
            } else if (button.textContent.trim() === "Trimestriels") {
                monthlyGrid.classList.add("visible");
                yearlyGrid.style.opacity = "0.5";
                monthlyGrid.style.opacity = "1";
                yearlyGrid.classList.remove("visible")
                
            }
        });
    
    });

});



</script>
<body>
    <?php include('global/header.php') ?>
    <main>
        <section id="prices-container">
            <h1>Nos Tarifs</h1>
            <div class="toggle-buttons">
                <button class="toggle-btn active">Annuels</button>
                <button class="toggle-btn">Trimestriels</button>
            </div>
            <div id="card-grid">
                <div id="card-grid-yearly">
                    <div class="card dark">
                        <h2>Cotisation Annuelle + Licence fédérale</h2>
                        <p class="price">111€<span>/an</span></p>
                    </div>
                    <img src="img/plus.png" id="img-plus" alt="plus">
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
                    <img src="img/plus.png" id="img-plus" alt="plus">
                    <div class="card light">
                        <h2>Forfait Trimestriel</h2>
                        <p class="price">220€<span>/trimestre</span></p>
                    </div>
            </div>
                 
</main>
<?php include('global/footer.php') ?>
</body>
</html>
