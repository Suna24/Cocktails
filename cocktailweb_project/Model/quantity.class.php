<?php
include("./ingredient.class.php");
class quantity
{
    private $ingredient;
    private $value;
    private $unit;

    public function __construct(ingredient $ingredient,string $unit, string $value)
    {
        $this->ingredient = $ingredient;
        $this->unit = $unit;
        $this->value = $value;
    }

    public function getIngredient(){
        return $this->ingredient;
    }

    public function getUnit(){
        return $this->unit;
    }

    public function getValue(){
        return $this->value;
    }
}