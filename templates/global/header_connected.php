
<style>
    body {
        font-family: Arial, sans-serif; /* police d'écriture à modifier */
        line-height: 1.6;
    }
    
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
    }
    
    header .logo {
        font-size: 24px;
        font-weight: bold;
    }
    
    nav {
        display: flex;
        gap: 40px;
    }
    
    nav a {
        text-decoration: none;
        color: black;
        font-size: 20px;
    }
    .bouton-compte {
        display: flex;
        border-radius: 5px;
    }
    
    .bouton-compte button {
        flex-wrap: wrap;
        margin-left: 10px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
    }
    
    .compte-view:hover {
        background-color:#2e2d2d;
    }
    
    .bouton-compte .compte-view, .compte-view a {
        background-color: black;
        color: white;
    }
   
    a {
        color:black;
        text-decoration: none;
    }
</style>
<?php require_once 'php/utils/UserTools.php'; ?>
    <header>
            <div class="logo"><a href="index_connected.php">Logo</a></div>
            <nav>
                <a href="planning-adherent.php">Votre planning</a>
                <a href="#">Votre niveau</a>
                <a href="#">Vos factures</a>
               
            </nav>
            <div class="bouton-compte">
                <button class="compte-view"><a href="index.php">Mon compte</a></button>
            </div>
    </header>