<html>
<body>
<?php
include_once('./db.inc.php');
include_once('./cocktail.class.php');

error_reporting(E_ERROR | E_PARSE);

//TODO name / recette / array de quantités
$ingredients = array();

//Création de la base de données
$db = new PDO("$server:host=$host;dbname=$base",$user,$pass);

if(isset($_GET['ing']) && is_string($_GET['ing']) ){
    $search=$_GET['ing'];
}

$sql = "SELECT DISTINCT * FROM ingredient";

if(isset($search) && is_string($search)){
    $sql .= " WHERE name LIKE \"%".$search."%\"";
}

//ICI on créé l'ensemble des ingrédients de la base
foreach ($db->query($sql) as $ligne) {
    array_push($ingredients,new ingredient($ligne[name]));
}

//ensuite pour chaque cocktail on itère pour créer ses quantités et l'ajouter à la liste
foreach ($ingredients as $cocktail){
    if($cocktail instanceof ingredient){
        echo $cocktail->toHtml();
    }
}


?>

</body>
</html>
