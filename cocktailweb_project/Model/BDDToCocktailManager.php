<html>
<body>
<?php
include_once('./db.inc.php');
include_once('./cocktail.class.php');

error_reporting(E_ERROR | E_PARSE);

//TODO name / recette / array de quantités
$cocktails = array();

//TODO name of each cocktail
$cocktail_name = array();

//TODO name
$ingredients_to_create = array();

//TODO ingrédient / value / unit
$quantities = array();

if (isset($_GET['q']) && is_string($_GET['q'])) {
    $search = $_GET['q'];
}

//Création de la base de données
$db = new PDO("$server:host=$host;dbname=$base", $user, $pass);

$sql = "SELECT DISTINCT cname FROM cocktail INNER JOIN quantite ON cocktail.id = quantite.cocktail_id INNER JOIN ingredient ON quantite.ingredient_id = ingredient.id";

if (!empty($_GET['check_list']) && isset($search)) {
    //TODO les deux champs sont set
    $i = 0;
    $sql .= " WHERE cname LIKE \"%$search%\" AND ";
    $numItems = count($_GET['check_list']);
    $sql .= "name IN (\"";
    foreach ($_GET['check_list'] as $check) {
        $sql .= $check . "\"";
        //Fin du tableau
        if (++$i === $numItems) {
            $sql .= ")";
        } else {
            $sql .= ",\"";
        }
        //echo $sql;
    }
    $sql .= " GROUP BY cname HAVING COUNT(distinct name) = " . $i . ";";
} else if (isset($search)) {
    $sql .= " WHERE cname LIKE \"%$search%\"";
} else if (!empty($_GET['check_list'] && is_array($_GET['check_list']))) {
    //echo "I'm in";
    //TODO le champ d'ingrédients est set
    $i = 0;
    $numItems = count($_GET['check_list']);
    $sql .= " WHERE name IN (\"";
    foreach ($_GET['check_list'] as $check) {
        $sql .= $check . "\"";
        //Fin du tableau
        if (++$i === $numItems) {
            $sql .= ")";
        } else {
            $sql .= ",\"";
        }
    }
    $sql .= " GROUP BY cname HAVING COUNT(distinct name) = " . $i . ";";
    //echo $sql;
}

foreach ($db->query($sql) as $ligne) {
    array_push($cocktail_name, $ligne[cname]);
}
//ICI on créé l'ensemble des ingrédients de la base
$sql = "SELECT * FROM ingredient";
foreach ($db->query($sql) as $ligne) {
    array_push($ingredients_to_create, new ingredient($ligne[name]));
}
foreach ($ingredients_to_create as $ligne) {
    if ($ligne instanceof ingredient) {
        //echo $ligne->getName() . " | ";
    }

}

//ensuite pour chaque cocktail on itère pour créer ses quantités et l'ajouter à la liste
foreach ($cocktail_name as $ckt) {
    $recipe = "";
    $image = "";
    $like = 0;
    $dislike = 0;
    //TODO une requête pour le nom du cocktail et sa recette ainsi que le nombre d'ingrédients
    /*SELECT cname, recette, COUNT(quantite.cocktail_id) FROM cocktail
     INNER JOIN quantite ON quantite.cocktail_id = cocktail.id WHERE cname=\"$ckt\";*/


    //TODO une seconde requête pour tous les ingrédients et les quantités
    $sql = "SELECT cname, image, recette, `like`, dislike, name, value, unit FROM cocktail
    INNER JOIN quantite ON quantite.cocktail_id=cocktail.id 
    INNER JOIN ingredient ON ingredient.id=quantite.ingredient_id
WHERE cname=\"$ckt\";";
    foreach ($db->query($sql) as $ligne) {
        /*echo $ligne[cname] . " ";
         //echo $ligne[recette] . " ";
         echo $ligne[name] . " ";
         echo $ligne[value]. " ";
         echo $ligne[unit]. "<br>";*/
        $recipe = $ligne[recette];
        $image = $ligne[image];
        $like = $ligne[like];
        $dislike = $ligne[dislike];
        array_push($quantities, new quantity(new ingredient($ligne[name]), $ligne[unit], $ligne[value]));
    }

    // Récupération des réactions sur les cocktails
    $sqlLike = "SELECT SUM(reaction) FROM reactions INNER JOIN cocktail ON reactions.id = cocktail.id WHERE cocktail.cname = '$ckt' and reaction = '1';";
    $sqlDislike = "SELECT SUM(reaction) FROM reactions INNER JOIN cocktail ON reactions.id = cocktail.id WHERE cocktail.cname = '$ckt' and reaction = '-1';";
    foreach ($db->query($sqlLike) as $ligne) {
        $like = $ligne['SUM(reaction)'] ?: 0;
    }
    foreach ($db->query($sqlDislike) as $ligne) {
        $dislike = abs($ligne['SUM(reaction)'] ?: 0);
    }
    array_push($cocktails, new cocktail($ckt, $recipe, $quantities, $image, $like, $dislike));
    $quantities = array();
}
foreach ($cocktails as $cocktail) {
    if ($cocktail instanceof cocktail) {
        echo $cocktail->toHtml();
    }
}
?>

</body>
</html>