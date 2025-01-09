<style>
footer {
    background-color: #f9f9f9;
    padding: 10px;
    border-top: 1px solid #ddd;
    font-size: 14px;
    margin-top : 100px;
}

.media {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

#espace-logo {
    flex: 1;
    min-width: 200px;
    text-align: left;
}

#espace-logo .logo {
    width: 50px;
    height: auto;
    margin-bottom: 2%;
}

#espace-logo>#social-icons {
    display: flex;
}

#espace-logo>#social-icons a img {
    width: 24px;
    height: 24px;
}

#espace-logo>#social-icons a img:hover {
    transform: scale(1.1);
} /* agrandi le logo lorsque hover */

.liste {
    display: flex;
    flex: 3;
    justify-content: space-between;
    list-style: none;
}

.colonne {
    flex: 1;
    padding-left: 10%;
}

.colonne>h3 {
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: bold;
}

.colonne>ul {
    list-style: none;
}

.colonne>ul>li a {
    text-decoration: none;
    color: #333;
}

.colonne>ul>li a:hover {
    color: #007bff;
}

#mention {
    text-align: center;
    border-top: 1px solid #ddd;
    padding-top: 1%;
    color: #666;
    font-size: 12px;
}
</style>
<footer>
    <div class="media">
        <div id="espace-logo">
            <img src="logo.png" alt="Logo" class="logo">
            <div id="social-icons">
                <a href="https://x.com"><img src="img/icon-social-media/twitter.png" alt="X"></a>
                <a href="https://www.instagram.com"><img src="img/icon-social-media/instagram.png" alt="Instagram"></a>
                <a href="https://www.youtube.com"><img src="img/icon-social-media/youtube.png" alt="YouTube"></a>
            </div>
        </div>

        <ul class="liste">
            <li class="colonne">
                <h3>Nous contacter</h3>
                <ul>
                    <li><a href="tel:+33102030405">Tel : +33 1 02 03 04 05</a></li>
                    <li><a href="mailto:grandgalop@mail.com">Email : Notre grandgalop@mail.com/a></li>
                    <li><a href="https://www.google.com/maps">Adresse : 2 rue du grand poney, Sologne</a></li>
                    <li><a href="#">Grand Galop</a></li>
                    <li><a href="#">Formulaire</a></li>
                </ul>
            </li>
            <li class="colonne">
                <h3>À propos de nous</h3>
                <ul>
                    <li><a href="#">Tarifs</a></li>
                    <li><a href="#">Planning</a></li>
                    <li><a href="#">Poneys</a></li>
                    <li><a href="#">Témoignages</a></li>
                </ul>
            </li>
            <li class="colonne">
                <h3>Compte</h3>
                <ul>
                    <li><a href="connexion.php">Se connecter</a></li>
                    <li><a href="#">Centre d'aide</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div id="mention">
        <p>Mentions légales et conditions d’utilisations</p>
    </div>
</footer>
