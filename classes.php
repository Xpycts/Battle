<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 18.06.13
 * Time: 10:20
 * To change this template use File | Settings | File Templates.
 */

class Factory
{
    // Параметризированный фабричный метод
    public static function create($class)
    {
        try{

            if (include_once (__DIR__.CLASS_DIR . $class . '.php')){
                return new $class;
            }
            else
                throw new Exception('Класс не найден');
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}

abstract class WareHouse {
    static protected $items = array();

    function __construct(array $items_array){
        self::$items = $items_array;
    }

    static function getWarehouse(){
        return self::$items;
    }

    static function getCount(){
        return count(self::$items);
    }

    static function getRandomItem(){
        return self::$items[rand(0,self::getCount()-1)];
    }

}

class WeaponWarehouse extends WareHouse {
    static function getRandomItem(){
        list($name, $strength)=self::$items[rand(0,self::getCount()-1)];
        return new weapon($name, $strength);
    }
}
class ArmorWarehouse extends WareHouse {
    static function getRandomItem(){
        list($name, $strength)=self::$items[rand(0,self::getCount()-1)];
        return new armor($name, $strength);
    }
}
class UnitWarehouse extends WareHouse {}

?>