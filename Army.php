<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 07.06.13
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */

class Army {
    private $Units = array();
//    private $City=null; //ссылка на город которому принадлежит армия

    function __construct(/*City $City*/){
//        $this->City=$City;
    }

/*    function getCity() {
        return $this->City;
    }

    function setCity(City $City){
        $this->City=$City;
    }*/

    function getUnits(){
        return $this->Units;
    }

    function addUnit(Unit $unit){
        array_push($this->Units,$unit);
    }

//    @TODO проверить правильность склеивания
    function glueArmy(Army $addArmy){ //соединяем две армии
        $this->Units=array_merge($this->Units,$addArmy->getUnits());
    }

    function randArmy($maxUnitCount=5) {
        for($i=1;$i<=rand(1,$maxUnitCount);$i++)
        {
            $armors=array();
            list($name,$health,$strength)=UnitWarehouse::getRandomItem();
            for($i=1;$i<=rand(0,3);$i++) //генерируем рандомное кол-во брони
                $armors[]=ArmorWarehouse::getRandomItem();
            $this->addUnit(new warriorUnit($name,$health,$strength,WeaponWarehouse::getRandomItem(),$armors));
        }
    }

//    @TODO одинаковые юниты выводить в виде массива, например - Лучники[5]
    function printArmy(){
        foreach($this->Units as $unit){
            if (is_array($unit)) { //если юнет не один а в массиве то обрабатываем массив
                foreach ($unit as $u)
                    echo $u;
            }else {
                echo $unit;
            }
        }
    }

    function prepareForBattle(){
        foreach ($this->Units as $unit) $unit->prepareForBattle();

    }

    function setDamage($damage){ //наносим повреждения всем юнитам армии
        foreach ($this->Units as $unit) $unit->setDamage($damage);
    }

    function checkDead(){ //проверяем и удаляем мертвые юниты
        foreach ($this->Units as $i => $unit)
            if ($unit->getCurrentHealth()<=0) {
                $this->killUnit($i);
            };
        return (count($this->Units)>0);
    }

    function killUnit($num){
        array_splice($this->Units,$num,1);
//        unset($unit); //@TODO проверить действительно ли объект удаляется из памяти

    }

}