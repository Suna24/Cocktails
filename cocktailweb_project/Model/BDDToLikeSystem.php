<?php

include_once('db.inc.php');

$cocktailName = $_POST['name'];

//Création de la base de données
$db = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$sql = "";

if (isset($_POST['like'])) {
    // TODO: Vérifier si l'utiliateur a déjà liké le cocktail
    $sql = "UPDATE cocktail SET `like` = `like` + 1 WHERE cname = '{$cocktailName}';";
} elseif (isset($_POST['dislike'])) {
    $sql = "UPDATE cocktail SET `dislike` = `dislike` + 1 WHERE cname = '{$cocktailName}';";
}
$db->exec($sql);

function checkUserReaction($cocktailName)
{
    $reaction = getUserReaction(getCocktailId($cocktailName));
    if ($reaction != "like" && $reaction != "dislike") {
        return false;
    } else {
        return true;
    }
}

function getCocktailId($cocktailName)
{
    $db = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    $sql = "SELECT `id` FROM cocktail WHERE cname = '{$cocktailName}';";
    $result = $db->query($sql);
    $result = $result->fetch();
    foreach ($result as $key => $value) {
        $cocktailId = $value;
        return $cocktailId;
    }
}

function getUserId($userName)
{
    $db = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    $sql = "SELECT `id` FROM user WHERE username = '{$userName}';";
    $result = $db->query($sql);
    $result = $result->fetch();
    foreach ($result as $key => $value) {
        $id = $value;
    }
    return $id;
}

function getUserReaction($cocktailId)
{
    $userId = getUserId($_SESSION['username']);
    $sql = "SELECT `reaction` FROM reactions WHERE id = '{$cocktailId}' and user_id = '{$userId}';";
    foreach ($db->query($sql) as $row) {
        if ($row['reaction'] == 1) {
            return "like";
        } elseif ($row['reaction'] == -1) {
            return "dislike";
        }
    }
}
