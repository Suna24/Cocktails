<?php
session_start();
include 'admin_pass.php';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["passhash"])) {
    if (password_verify($admin_passwd_hash, $_SESSION["passhash"])) {
        echo "admin";
    } else {
        header("location: accueil.html");
        die("Redirection vers accueil.html");
    }
} else {
    header("location: login-page.php");
    die("Redirection vers login-page.php");
}
