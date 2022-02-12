<?php

class ingredient
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function toHtml(){
        $result = "<option value=\"".$this->name."\">";
        return $result;
    }
}