<?php
include_once('db.inc.php');
session_start();

//Création de la base de données
$db = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$cocktailId = $_POST['id'];

displayUpdatedReactions($db, $cocktailId);

function displayUpdatedReactions($db, $cocktailId)
{
    $sql = "SELECT COUNT(reaction) FROM reactions WHERE id = '" . $cocktailId . "' and reaction = '1';";
//    echo $sql;
    $result = $db->query($sql);
    $result = $result->fetch();
    echo $result[0];

    echo "/";

    $sql = "SELECT COUNT(reaction) FROM reactions WHERE id = '" . $cocktailId . "' and reaction = '-1';";
//    echo $sql;
    $result = $db->query($sql);
    $result = $result->fetch();
    echo $result[0];
}