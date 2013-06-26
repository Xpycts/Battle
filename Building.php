<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 24.06.13
 * Time: 18:04
 * To change this template use File | Settings | File Templates.
 */

abstract class Building {
    private $level=1;

    function getLevel(){
        return $this->level;
    }

    function upLevel(){
        $this->level++;
    }
}

class Research extends Building {} //лаборатория
class Mill extends Building {} //мельница
class SawMill extends Building {} //лесопилка
class Quarry extends Building {} //каменоломня
class IronMine extends Building {} //железный рудник
class Market extends Building {} //рынок
class TownHall extends Building {} //ратуша, производит людей, от уровня ратуши зависит число людей, для пороизводства зданий тоже нужны люди(чтобы работать в них)
class Smithy extends Building {} //кузница, производим оружие и доспехи
class Barracks extends Building {} //казармы, создаем солдат из людей и оружия
class Wall extends Building {} //стена
class Tower extends Building {} //защитная башня

