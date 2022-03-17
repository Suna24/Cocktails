<?php
include_once "../Model/Login_System/admin_check.php"
?>
<!DOCTYPE html><html lang="fr">
<head>
    <link rel="icon" href="https://cdn.discordapp.com/attachments/927911630602403880/931129861945294849/cocococococococockail.png">
    <meta charset="UTF-8">
    <title>TurboCocktail - Ajout</title>

    <link href="CSS_STYLES/sidebar.css" rel="stylesheet">
    <link href="CSS_STYLES/accueil.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation -->
    <nav role="navigation" id="nav">
        <button id="openbtn_id" class="openbtn" onclick="window.location.href='accueil.html'">Accueil</button>
        <p id="title">Ajouter un cocktail à la base de données</p>
    </nav>

    <!-- Barre de progression -->
    <div id="progress"></div>

    <div class="page">
        <form id="ajouter" method="post" action="../Model/ajout.php">

            <fieldset>
                <h3>Le cocktail</h3>
                <input class="cocktailName" id="cocktailName" type="text" placeholder="Le nom de votre cocktail" pattern="[^()/><\][\\\x22,;|]+" required/>
            </fieldset>

            <fieldset id="ing">
                <h3>Les ingrédients</h3>
                <div id="firstNode" class="ingredient">
                    <input id="ingredient" class="nameIngredient" list="ingredients" type="text" placeholder="Ingrédient" required/>
                    <datalist id="ingredients"></datalist>
                    <input class="quantite" type=text" placeholder="Quantité" required/>
                    <input class="unite" type="text" placeholder="Unité" required/>
                </div>

                <span onclick="newElement()" class="add">+</span>
            </fieldset>

            <fieldset>
                <h3>La recette</h3>
                <textarea id="recette" type="text" placeholder="La recette" required></textarea>
            </fieldset>

            <fieldset>
                <h3>La photo</h3>
                <input id="photo" type="text" placeholder="Lien de la photo" required/>
            </fieldset>

            <input name="payload" type="hidden" id="payload"/>

            <div id="containAddLink">
                <input id="addCocktail" class="ajout" type="submit" value="Enregistrer le cocktail !"/>
            </div>

       </form>
    </div>

    <!-- Bas de page -->
    <footer id="footer">
        <p class="firstFooter">Réalisé par le turbo groupe : Antonin, Bastien, Erhan, Simon</p>
        <p>Mentions légales, All Rights Reserved <a href="login-page.php">©</a></p>
    </footer>

</body>
<script src="../Controller/loadbar.js"></script>
<script src="../Controller/addIngredientToTheList.js"></script>
<script src="../Model/Ingredient.js"></script>
</html>