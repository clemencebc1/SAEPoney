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

.boutons-log button:hover {
    background-color: #f0f0f0;
}

.boutons-log .register, .register a {
    background-color: black;
    color: white;
}
.sign-in {
    color: black;
}
a:visited {
    color: black;
}
a {
    color:black;
    text-decoration: none;
}
</style>
<header>
        <div class="logo"><a href="index.php">Logo</a></div>
        <nav>
            <a href="#">Nos tarifs</a>
            <a href="#">Notre planning</a>
            <a href="#">Nos poneys</a>
            <a href="#">Actualités</a>
            <a href="#">Témoignages</a>
            <a href="#">Contact</a>
        </nav>
        <div class="boutons-log">
            <button class="sign-in"><a href="connexion.php">Sign in</a></button>
            <button class="register"><a href="#">Register</a></button>
        </div>
</header>