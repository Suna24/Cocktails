<?php

include_once('db.inc.php');
session_start();

//Création de la base de données
$db = new PDO("$server:host=$host;dbname=$base", $user, $pass);

$cocktailName = $_POST['name'];
$cocktailId = getCocktailId($db, $cocktailName);
$username = $_SESSION['username'];
$userId = getUserId($db, $username);
$userReaction = getUserReaction($db, $cocktailId, $userId);

$sqlUpdate = "";
$sqlSelect = "";


if (isset($_POST['like'])) {
    manageLikeUserReaction($db, $cocktailId, $userId, $userReaction);
} elseif (isset($_POST['dislike'])) {
    manageDislikeUserReaction($db, $cocktailId, $userId, $userReaction);
}


function manageLikeUserReaction($db, $cocktailId, $userId, $reaction)
{
//    echo "Réaction actuelle : " . $reaction . "\n";
    if ($reaction == null) {
        // insérer une nouvelle reaction avec 'reaction' = 1
//        echo "insertion \n";
        insertUserReaction($db, $cocktailId, $userId, 1);
    } else {
        // modifier la reaction de l'utilisateur
//        echo "modification \n";
        if ($reaction == "like") {
            updateUserReaction($db, $cocktailId, $userId, 0);
        } else {
            updateUserReaction($db, $cocktailId, $userId, 1);
        }
    }

}

function manageDislikeUserReaction($db, $cocktailId, $userId, $reaction)
{
    //echo "Réaction actuelle : " . $reaction . "\n";
    if ($reaction == null) {
        // insérer une nouvelle reaction avec 'reaction' = -1
//        echo "insertion \n";
        insertUserReaction($db, $cocktailId, $userId, -1);
    } else {
        // modifier la reaction de l'utilisateur
//        echo "modification \n";
        if ($reaction == "dislike") {
            updateUserReaction($db, $cocktailId, $userId, 0);
        } else {
            updateUserReaction($db, $cocktailId, $userId, -1);
        }
    }
}


function getCocktailId($db, $cocktailName)
{
    $sql = "SELECT `id` FROM cocktail WHERE cname = '{$cocktailName}';";
    //echo $sql;
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

function getUserReaction($db, $cocktailId, $userId)
{
    $sql = "SELECT `reaction` FROM reactions WHERE id = '{$cocktailId}' and user_id = '{$userId}';";
//    echo "SQL : " . $sql . "\n";
    foreach ($db->query($sql) as $row) {
        if ($row['reaction'] == 1) {
            return "like";
        } elseif ($row['reaction'] == -1) {
            return "dislike";
        } else {
            return "none";
        }
    }
}

function insertUserReaction($db, $cocktailId, $userId, $reaction)
{
    $sql = "INSERT INTO `reactions` (`id`, `user_id`, `reaction`) VALUES ('{$cocktailId}', '{$userId}', '{$reaction}');";
//    echo $sql;
    $db->exec($sql);
}

function updateUserReaction($db, $cocktailId, $userId, $reaction)
{
    $sql = "UPDATE `reactions` SET `reaction` = '{$reaction}' WHERE `id` = '{$cocktailId}' and `user_id` = '{$userId}';";
//    echo $sql;
    $db->exec($sql);
}
