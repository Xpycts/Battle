<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 07.06.13
 * Time: 12:58
 * To change this template use File | Settings | File Templates.
 */

/* Создаем каркас небольшой игры средствами ООП */

//@TODO автолоадер классов
require_once(__DIR__."\classes.php");
include_once(__DIR__."\constant.php");
require(__DIR__."\Unit.php");
require(__DIR__."\Item.php");
require(__DIR__."\Army.php");
require(__DIR__."\MapPoint.php");
require(__DIR__."\City.php");
require(__DIR__."\Pole.php");

$pole=Pole::getInstance();
$pole->initMap();
$City1=$pole->addCity();
$City2=$pole->addCity();
$City1->getArmy()->randArmy();
$City2->getArmy()->randArmy();
echo "Армия1:\r\n";
$City1->getArmy()->printArmy();
echo "Армия2:\r\n";
$City2->getArmy()->printArmy();
//$pole->renderMap();
$distance=$pole->getDistance($City1, $City2);
echo "City2 attack City1!!!\r\n";
echo "Battle begin after ".round($distance*MAP_ONE_POLE_SPEED)." sec\r\n";
$wave=$City1->battle($City2->getArmy());
echo "Битва окончена!!! Прошло $wave сражений.\r\n";
echo "Армия1:\r\n";
$City1->getArmy()->printArmy();
echo "Армия2:\r\n";
$City2->getArmy()->printArmy();


?>