<?php
function console․log($message) {
    echo "<script type=\"text/javascript\"> console.log(\"". $message ."\"); </script>";
}


session_start();
$line = "Pseudo : ";
$line .= $_SESSION["username"] ?? "Pas connecté";
$line .= "<br>";

echo $line;
console․log($line);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="icon" href="https://cdn.discordapp.com/attachments/927911630602403880/931129861945294849/cocococococococockail.png">
        <meta charset="UTF-8">
        <title>Test Like</title>
    </head>
    <body>
        <button id="like" value="LIKE" onclick="addLike()">LIKE</button>
        <button id="dislike" value="DISLIKE" onclick="addDislike()">DISLIKE</button>
    </body>
</html>

<script src="like.js"></script>
