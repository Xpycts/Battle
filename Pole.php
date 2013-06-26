<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 07.06.13
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */

class EmptyMapException extends \Exception {}

class Pole{
    /*Синглтоны нельзя сериализовывать. Они не могут быть подклассами (до PHP 5.3) и не будут собираться сборщиком мусора из-за того, что экземпляр хранится в статическом атрибуте Синглтона.*/
    private static $Instance=null;  //реализуем паттерн одиночка/singleton
    private function __construct(){}
    private function __clone(){}

    static function getInstance(){
        if (self::$Instance==null)
            return new self;
        else
            return self::$Instance;
    }

    private $Map = array();

    protected function generateMap(){ //создаем новое поле
        $newMap = array();
        for ($i=0;$i<MAP_SIZE_X;$i++)
        {
            $buf=array();
            for ($j=0;$j<MAP_SIZE_Y;$j++)
                if (rand(0,99)<MAP_RESOURCE_CHANCE) //расставляем на поле ячейки с ресурсами
                    $buf[]=new Resource($i,$j);
                else
                    $buf[]=0;
            $newMap[]=$buf;
        }

        return $newMap;
    }

    function initMap(){ //инициализируем поле
        //востанавливаем состояние из БД(кэша) или генерируем на лету(для тестов)
        $this->Map=$this->generateMap();
    }

    function renderMap(){ //отрисовываем поле на экран
        try {
            if (!count($this->Map)) throw new EmptyMapException("Карта не инициализирована!");
        } catch(\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }

        for ($i=0;$i<MAP_SIZE_X;$i++)
        {
            for ($j=0;$j<MAP_SIZE_Y;$j++)
                echo $this->Map[$i][$j]." ";
            echo "\r\n";
        }
    }

    private function randomMapPosition(){
        $x=rand(0,MAP_SIZE_X-1);
        $y=rand(0,MAP_SIZE_Y-1);
        if (!is_object($this->Map[$x][$y]))
            return array($x,$y);
        else
            $this->randomMapPosition();
    }

    function addCity($x=null,$y=null){
        if (!$this->haveFreeResource()) return false;

        if (($x===null && $y===null) || is_object($this->Map[$x][$y]))
            list($x,$y)=$this->randomMapPosition();

        $this->Map[$x][$y]= new City($x,$y);
        if ($this->Map[$x][$y] instanceof City)
            return $this->Map[$x][$y];
        else
            return false;
    }

    function getDistance(MapPoint $pointone, MapPoint $pointtwo){ //вычисляем расстояние между точками на карте
        $catet=abs($pointone->get_X()-$pointtwo->get_X());
        $gipoten=abs($pointone->get_Y()-$pointtwo->get_Y());
        return sqrt($catet*$catet+$gipoten*$gipoten)-1;
    }

    private function haveFreeResource(){
        for ($i=0;$i<MAP_SIZE_X;$i++)
            for ($j=0;$j<MAP_SIZE_Y;$j++)
                if (!is_object($this->Map[$i][$j])) return true;
        return false;
    }

}



class Resource extends MapPoint {
    function __toString(){
        return "1";
    }
}

class Forest extends Resource {

}

class Stone extends Resource {

}

class Steel extends Resource {

}

class Oil extends Resource {

}


