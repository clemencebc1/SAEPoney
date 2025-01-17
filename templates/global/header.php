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
    header .logo img{
        height:75px;

    }
    nav {
        display: flex;
        gap: 55px;
    }
    nav a {
        text-decoration: none;
        color: black;
        font-size: 20px;
    }
    .boutons-log {
        display: flex;
    }
    .boutons-log button {
        flex-wrap: wrap;
        margin-left: 10px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
        border-radius: 3px;
    }
    .sign-in:hover {
        background-color: #f0f0f0;
    }
    .register:hover {
        background-color:#2e2d2d;
    }
    .boutons-log .register, .register a {
        background-color: black;
        color: white;
    }
    .sign-in {
        color: black;
    }
    a {
        color:black;
        text-decoration: none;
    }
</style>
<header>
        <div class="logo">
            <a href="index.php"><img src="img/grand_galot.jpg" alt="logo"></a>
        </div>
        <nav>
            <a href="tarifs.php">Nos tarifs</a>
            <a href="planning-club.php">Notre planning</a>
            <a href="poneys.php">Nos poneys</a>
            <a href="actualites.php">Actualités</a>
            <a href="avis.php">Témoignages</a>
            <a href="#">Contact</a>
        </nav>
        <div class="boutons-log">
            <button class="sign-in"><a href="connexion.php">Sign in</a></button>
            <button class="register"><a href="inscription.php">Register</a></button>
        </div>
</header>