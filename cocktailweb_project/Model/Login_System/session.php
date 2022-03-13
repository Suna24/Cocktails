<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    echo "redirect";
} else {
    echo isset($_SESSION["username"]) ? ", ".$_SESSION["username"] : "";
}
