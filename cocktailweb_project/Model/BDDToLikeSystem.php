<?php

include_once ('db.inc.php');

    $cocktailName = $_POST['name'];

    //Création de la base de données
    $db = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    $sql="";

    if(isset($_POST['like'])) {
        $sql = "UPDATE cocktail SET `like` = `like` + 1 WHERE cname = '{$cocktailName}';";
    } elseif (isset($_POST['dislike'])){
        $sql = "UPDATE cocktail SET `dislike` = `dislike` + 1 WHERE cname = '{$cocktailName}';";
    } else {
        $sql="";
    }
    $db->exec($sql);

