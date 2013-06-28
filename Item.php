<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 13.06.13
 * Time: 19:47
 * To change this template use File | Settings | File Templates.
 */

class WrongItemException extends \Exception {}

abstract class Item { //базовый класс для оружия или брони
    protected $name;
    protected $strength;

    function __construct($name=null, $strength=null) {
        if (!$name&&$strength) {
            throw new WrongItemException("Имя класса не задано!");
            $name="Unnamed";
        }

        if ($name)
            $this->name=$name;
        if ($strength)
            $this->strength=$strength;
    }

    function __toString(){
        return "I have $this->name with strength $this->strength\r\n";
    }

    function getName(){
        return $this->name;
    }

    function setName(){
        return $this->name;
    }

    function action(){
        return $this->strength;
    }
}

class weapon extends Item {
    protected  $name="Hand";
    protected  $strength=1;
}


class armor extends Item {
    protected  $name="NakedBody";
    protected  $strength=0;
}

?>