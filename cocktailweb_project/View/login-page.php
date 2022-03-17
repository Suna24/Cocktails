<?php

session_start();

?>

<!DOCTYPE html><html lang="fr">
<head>
    <link rel="icon" href="https://cdn.discordapp.com/attachments/927911630602403880/931129861945294849/cocococococococockail.png">
    <meta charset="UTF-8">
    <title>TurboCocktail - Connexion</title>

    <link href="CSS_STYLES/sidebar.css" rel="stylesheet">
    <link href="CSS_STYLES/accueil.css" rel="stylesheet">
    <link href="CSS_STYLES/login.css" rel="stylesheet">
</head>
<body>

    <!-- Barre de navigation -->
    <nav role="navigation" id="nav">
        <button id="openbtn_id" class="openbtn disabled">Accueil</button>
        <p id="title">Connexion</p>
    </nav>

    <!-- Barre de progression -->
    <div id="progress"></div>

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Se connecter</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">S'inscrire</label>
            <div class="login-form" method="post" action="../Model/register.php">
                <div class="sign-in-htm">
                    <form method="post">
                    <div class="group">
                        <label for="user-signin" class="label">Nom d'utilisateur</label>
                        <input id="user-signin" name="username-signin" type="text" class="input" required>
                    </div>
                    <div class="group">
                        <label for="pass-signin" class="label">Mot de passe</label>
                        <input id="pass-signin" name="password-signin" type="password" class="input" data-type="password" required>
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Rester connecté</label>
                    </div>
                    <div class="group">
                        <input type="submit" name="login" class="button" value="Se connecter" onclick="test()">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Mot de passe oublié ?</a>
                    </div>
                    </form>
                </div>
                <div class="sign-up-htm">
                    <form method="post">
                    <div class="group">
                        <label for="user-signup" class="label">Nom d'utilisateur</label>
                        <input id="user-signup" name="username-signup" type="text" class="input" required>
                    </div>
                    <div class="group">
                        <label for="pass-signup" class="label">Mot de passe</label>
                        <input id="pass-signup" name="password-signup" type="password" class="input" data-type="password" required>
                    </div>
                    <div class="group">
                        <label for="pass-confirm-signup" class="label">Répéter le mot de passe</label>
                        <input id="pass-confirm-signup" name="confirm_password-signup" type="password" class="input" data-type="password" required>
                    </div>
                    <div class="group">
                        <input type="submit" name="register" class="button" value="S'inscrire">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">J'ai déjà un compte</label>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bas de page -->
    <!--TODO: Fix la position du footer proprement -->
    <footer id="footer" style="position: absolute">
        <p class="firstFooter">Réalisé par le turbo groupe : Antonin, Bastien, Erhan, Simon</p>
        <p>Mentions légales, All Rights Reserved</p>
    </footer>

</body>
<script src="../Controller/loadbar.js"></script>
</html>
<?php
include_once "../Model/Login_System/register.php";
include_once "../Model/Login_System/login.php";

if (isset($_POST["redirect"])){
    logTitle("Tu dois être connecté !");
}

function logTitle($message){
    echo "<script type=\"text/javascript\" defer> 
                let title = document.getElementById(\"title\");
                title.innerHTML = \"". $message ."\"; 
                title.style.color = \"red\";
          </script>";
    echo "<script type=\"text/javascript\" defer> console.log(\"". $message ."\"); </script>";
}
?>