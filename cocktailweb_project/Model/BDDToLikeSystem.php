<?php

include_once('db.inc.php');
session_start();

$cocktailName = $_POST['name'];

//Création de la base de données
$db = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$sql = "";


if (isset($_POST['like'])) {
    checkUserReaction($db, $cocktailName);
    $sql = "UPDATE cocktail SET `like` = `like` + 1 WHERE cname = '{$cocktailName}';";
} elseif (isset($_POST['dislike'])) {
    $sql = "UPDATE cocktail SET `dislike` = `dislike` + 1 WHERE cname = '{$cocktailName}';";
}
$db->exec($sql);

function checkUserReaction($db, $cocktailName)
{
    $cocktailId = getCocktailId($db, $cocktailName);
    $userId = getUserId($db, $_SESSION['username']);
    $reaction = getUserReaction($db, $cocktailId);
    if ($reaction == "") {
        // insérer une nouvelle reaction avec 'reaction' = 1
        echo "insertion \n";
        insertUserReaction($db, $cocktailId, $userId, 1);
    } else {
        // modifier la reaction de l'utilisateur
        echo "modification \n";
        if ($reaction == "like") {
            updateUserReaction($db, $cocktailId, $userId, 0);
        } else {
            updateUserReaction($db, $cocktailId, $userId, 1);
        }
    }
}

function writeFile($file, $content)
{
    $file = fopen($file, "w");
    fwrite($file, $content);
    fclose($file);
}

function getCocktailId($db, $cocktailName)
{
    $sql = "SELECT `id` FROM cocktail WHERE cname = '{$cocktailName}';";
    $result = $db->query($sql);
    $result = $result->fetch();
    foreach ($result as $key => $value) {
        $cocktailId = $value;
        return $cocktailId;
    }
}

function getUserId($db, $userName)
{
    $sql = "SELECT `id` FROM users WHERE username = '{$userName}';";
    $result = $db->query($sql);
    $result = $result->fetch();
    foreach ($result as $key => $value) {
        $id = $value;
    }
    return $id;
}

function getUserReaction($db, $cocktailId)
{
    $userId = getUserId($db, $_SESSION['username']);
    $sql = "SELECT `reaction` FROM reactions WHERE id = '{$cocktailId}' and user_id = '{$userId}';";
    foreach ($db->query($sql) as $row) {
        if ($row['reaction'] == 1) {
            return "like";
        } elseif ($row['reaction'] == -1) {
            return "dislike";
        }
    }
}

function insertUserReaction($db, $cocktailId, $userId, $reaction)
{
    $sql = "INSERT INTO `reactions` (`id`, `user_id`, `reaction`) VALUES ('{$cocktailId}', '{$userId}', '{$reaction}');";
    echo $sql;
    $db->exec($sql);
}

function updateUserReaction($db, $cocktailId, $userId, $reaction)
{
    $sql = "UPDATE `reactions` SET `reaction` = '{$reaction}' WHERE `id` = '{$cocktailId}' and `user_id` = '{$userId}';";
    echo $sql;
    $db->exec($sql);
}
