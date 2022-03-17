<?php
// Initialisation de la session
// session_start();

// Vérification si l'utilisateur est déjà connecté, si oui on le redirige à la page d'accueil
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // header("location: accueil.html");
    echo "<script type=\"text/javascript\"> window.location = \"accueil.html\" </script>";
    exit;
}

// Identifiants de connexion BDD
require_once ('db.inc.php');

try {
    $pdo = new PDO("$server:host=$host;dbname=$base",$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERREUR: Impossible de se connecter. " . $e->getMessage());
}

// initialisation des variables avec des valeurs vides
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Traitement des données du formulaire lorsqu'il est envoyé
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username-signin"]) && isset($_POST["password-signin"])){
    // Vérification si le nom d'utilisateur est vide
    if(empty(trim($_POST["username-signin"]))){
        $username_err = "Veuillez entrer un nom d'utilisateur.";
    } else{
        $username = trim($_POST["username-signin"]);
    }

    // Vérification si le mot de passe est vide
    if(empty(trim($_POST["password-signin"]))){
        $password_err = "Veuillez entrer un mot de passe.";
    } else{
        $password = trim($_POST["password-signin"]);
    }

    // Validation des identifiants
    if(empty($username_err) && empty($password_err)){
        // Création d'une requête préparée
        $sql = "SELECT id, username, password FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Assignation des variables comme paramètres à la requête préparée
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Attribution des paramètres
            $param_username = trim($_POST["username-signin"]);

            // Tentative d'exécution de la requête préparée
            if($stmt->execute()){
                // Vérification de l'existence du nom d'utilisateur, si oui on vérifie le mot de passe
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Le mot de passe est correct, donc on démarre une nouvelle session
                            // session_start();

                            // On stocke les données dans des variables de session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["passhash"] = password_hash($hashed_password, PASSWORD_DEFAULT);
                            console․log("hash : " . $hashed_password);
                            console․log("hash du hash : " . $_SESSION["passhash"]);

                            // On redirige l'utilisateur à la page d'accueil
                            // header("location: accueil.html");
                            echo "<script type=\"text/javascript\"> window.location = \"accueil.html\" </script>";
                        } else{
                            // Le mot de passe n'est pas valide, on affiche un message d'erreur générique
                            $login_err = "Nom d'utilisateur ou mot de passe invalide.";
                        }
                    }
                } else{
                    // Le nom d'utilisateur n'existe pas, on affiche un message d'erreur générique
                    $login_err = "Nom d'utilisateur ou mot de passe invalide.";
                }
            } else{
                logTitle("Oupsi ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.");
            }

            // Fermeture de la requête
            unset($stmt);
        }
    }

    // Fermeture de la connexion BDD
    unset($pdo);

    logTitle($username_err . $login_err . $password_err);
}


function console․log($message) {
    echo "<script type=\"text/javascript\"> console.log(\"". $message ."\"); </script>";
}

?>
