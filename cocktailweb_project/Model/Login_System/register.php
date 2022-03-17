<?php
// Identifiants de connexion BDD
require_once ('db.inc.php');

try {
    $pdo = new PDO("$server:host=$host;dbname=$base",$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERREUR: Impossible de se connecter. " . $e->getMessage());
}

// initialisation des variables avec des valeurs vides
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Traitement des données du formulaire lorsqu'il est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username-signup"]) && isset($_POST["password-signup"]) && isset($_POST["confirm_password-signup"])) {
    // Validation du nom d'utilisateur
    if(empty(trim($_POST["username-signup"]))){
        $username_err = "Please enter a username.";

    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username-signup"]))){
        $username_err = "Un nom d'utilisateur peut seulement contenir des lettres, nombres et underscores.";
    } else{
        // Préparation d'une requête SELECT
        $sql = "SELECT id FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Assignation des variables comme paramètres à la requête préparée
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Attribution des paramètres
            $param_username = trim($_POST["username-signup"]); // Suppression des espaces et caractères spéciaux

            // Tentative d'exécution de la requête préparée
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username-signup"]);
                }
            } else{
                logTitle("Oupsi ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.");
            }

            // Fermeture de la requête
            unset($stmt);
        }
    }

    // Validation du mot de passe
    if(empty(trim($_POST["password-signup"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password-signup"])) < 6){
        $password_err = "Le mot de passe doit comporter au moins 6 caractères.";
    } else{
        $password = trim($_POST["password-signup"]);
    }

    // Validation de la confirmation du mot de passe
    if(empty(trim($_POST["confirm_password-signup"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password-signup"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Vérification des erreurs de saisie avant l'insertion dans la BDD
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        // Préparation d'une requête INSERT INTO
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        //echo "<br>". $sql ."<br>";
        if($stmt = $pdo->prepare($sql)){
            // Assignation des variables comme paramètres à la requête préparée
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Attribution des paramètres
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe

            // Tentative d'exécution de la requête préparée
            if($stmt->execute()){
                // Redirection à la page de connexion après création de compte avec succès
                // header("location: login-page.php");
                echo "<script type=\"text/javascript\"> window.location = \"login-page.php\" </script>";
            } else{
                logTitle("Oupsi ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.");
            }

            // Fermeture de la requête
            unset($stmt);
        }
    }
    else {
        logTitle($username_err . $password_err . $confirm_password_err);
    }

    // Close connection
    unset($pdo);

}

?>
