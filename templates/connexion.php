<!DOCTYPE html>
<html lang="fr">
<?php include 'global/head.php'; 
title_html('Connexion');
link_to_css('static/connexion.css');

?>
<body>
    <?php include('global/header.php') ?>
    <main>
        <section id="login">
            <div class="form-section">
                <h1>Connexion</h1>
                <form action="" method="">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Votre email" required>
                    
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" placeholder="Votre mot de passe" required>
                    
                    <button type="submit" id="login-btn" onclick="" >Se connecter</button>
                </form>
                <p class="inscrire">Pas de compte ? <a href="inscription.php">Inscrivez-vous !</a></p>
            </div>
            <div id="image-section">
                <img src="img/poney-3.jpg" alt="poney">
            </div>
        </section>
    </main>
    <?php include('global/footer.php') ?>
</body>
</html>
