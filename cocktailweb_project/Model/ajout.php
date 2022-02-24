<?php

require_once ('db.inc.php');

//Variables
$cocktail = json_decode($_POST["payload"], true);

$cocktailName = $cocktail['nom'];
$cocktailRecette = $cocktail['recette'];
$cocktailPhoto = $cocktail['photo'];

$ingredients = $cocktail['ingredients'];

$ingredientsName = array();
$ingredientsQuantity = array();
$ingredientsUnity = array();

foreach ($ingredients as $value){
    array_push($ingredientsName, $value['name']);
    array_push($ingredientsQuantity, $value['quantity']);
    array_push($ingredientsUnity, $value['unity']);
}

//Création de la base de données
$db = new PDO("$server:host=$host; dbname=$base", $user, $pass);

//TODO Regarder si les ingrédients et/ou les cocktails sont déjà présents dans la BDD
$getAllCocktailNames = "SELECT cname FROM cocktail;";
$getAllIngredientNames = "SELECT name FROM ingredient;";

//Cocktail
$insertCocktail = $db->prepare("INSERT INTO cocktail(id, cname, recette, image) VALUES (NULL, :cname, :recette, :image)");
$insertCocktail->bindParam("cname", $cocktailName);
$insertCocktail->bindParam("recette", $cocktailRecette);
$insertCocktail->bindParam("image", $cocktailPhoto);
$insertCocktail->execute();

$idCocktail = $db->lastInsertId();

for($i = 0; $i < count($ingredientsName); $i++){

    //Ingredient & Quantite
    $insertIngredient = $db->prepare("INSERT INTO ingredient (id, name) VALUES (NULL, :ingName)");
    $insertQuantity = $db->prepare("INSERT INTO quantite (no, value, unit, cocktail_id, ingredient_id) VALUES (NULL, :qValue, :unit, :cocktailId, :ingredientId);");

    $insertIngredient->bindParam("ingName", $ingredientsName[$i]);
    $insertIngredient->execute();

    $ingredientID = $db->lastInsertId();

    $insertQuantity->bindParam("qValue", $ingredientsQuantity[$i]);
    $insertQuantity->bindParam("unit", $ingredientsUnity[$i]);
    $insertQuantity->bindParam("cocktailId", $idCocktail);
    $insertQuantity->bindParam("ingredientId", $ingredientID);

    $insertQuantity->execute();
}

/* Redirection vers la page d'accueil */
header('Location: http://cocktailproject.ddns.net/cocktailweb_project/View/accueil.html');
exit();

