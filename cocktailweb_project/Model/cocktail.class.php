<?php
include("./quantity.class.php");
class cocktail
{
    private $quantites;
    private $name;
    private $recette;
    private $image;

    public function __construct(string $name, string $recette, array $array, string $image)
    {
        $this->quantites = $array;
        $this->name = $name;
        $this->recette = $recette;
        $this->image = $image;
    }


    public function toHtml(){
        $result = "<div class=\"closed container\">
  <header class=\"toggle\" onClick=\"display(this)\">
    <div class=\"header\" style=\"background-image: url($this->image)\"></div>
    <div class=\"title\">".$this->name."</div>
  </header>
  <article>
    <ul class=\"ingredients\">";
        foreach($this->quantites as $ingredient)
        if($ingredient instanceof quantity) {
            $result .= "<li><div class=\"amount\">".$ingredient->getValue()." ".$ingredient->getUnit()."</div>
                        <div class=\"ingredient\">".$ingredient->getIngredient()->getName()."</div></li>";
        } else {
          echo "Erreur de formatage des données";
        }


    $result .= "</ul>
    <div class=\"preperation\"> 
      <div>".$this->recette."</div>
    </div>
  </article>
</div>";
        return $result;
    }
}
?>