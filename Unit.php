<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 07.06.13
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */
abstract class Unit {
    private $name; //имя юнита
    private $health; //здоровье юнита
    private $health_with_armor; //здоровье юнита для боя, изменяется при защите
    private $weight; //перевозимый груз

    private $weapon;
    private $armor=array();


    function __construct($name, $health, $weight, weapon $weapon=null, array $armors=null) {
        $this->name = $name;
        $this->health = $health;
        $this->weight = $weight;

        if (isset($weapon))
            $this->weapon= $weapon;
        else
            $this->weapon= new weapon();

        if (isset($armors))
            $this->giveArmors($armors);
    }

    function __toString() {
        return "Hi, I'm a $this->name. My health - $this->health($this->health_with_armor), i can transit - $this->weight. Weapon - ".$this->weapon->action().", armor - ".$this->allArmorStrength()." \r\n";
    }

    function getName(){
        return $this->name;
    }

    function giveWeapon(weapon $weapon){
        if ($this->weapon!=$weapon){
            unset($this->weapon);
            $this->weapon=$weapon;
        }
    }

    private function existArmor(armor $armor){ //проверяем есть ли уже у данного юнита устанавливаемое оружие
        foreach ($this->armor as $exist_armor)
            if ($exist_armor->getName()==$armor->getName())
                return true;
        return false;
    }

    function giveArmor(armor $armor){
        if (!$this->existArmor($armor)){
            $this->armor[]=$armor;
            return true;
        }
        return false;
    }

    function giveArmors(array $armors){
        foreach ($armors as $armor)
            if (!($armor instanceof armor)) throw new BadMethodCallException;
                $this->armor = $armors;
        return true;
    }

    function allArmorStrength() {
        $result=0;
        foreach ($this->armor as $armor)
            $result+=$armor->action();
        return $result;
    }

    protected function getWeapon(){
        return $this->weapon;
    }

    protected function getArmor() {
        return $this->armor;
    }

    function getAttackStrength() {
        return $this->weapon->action();
    }

    function getHealth(){
        return $this->health;
    }

    function getCurrentHealth(){ //текущее здоровье во время боя
        return $this->health_with_armor;
    }

    function prepareForBattle() {  //востанавливаем счетчики здоровья для битвы
        $this->health_with_armor=$this->health+$this->allArmorStrength(); //изначальное здоровье юниту суммируем с его броней
    }

    function setDamage($damage) {
        $this->health_with_armor-=$damage;
    }

}

class supplierUnit extends Unit {  //юнит снабженец

}

class warriorUnit extends Unit { //юнит воин

}

class Hero extends warriorUnit {

}
