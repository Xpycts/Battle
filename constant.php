<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 18.06.13
 * Time: 10:12
 * To change this template use File | Settings | File Templates.
 */
//Константы игры
define("MAP_SIZE_X",10);
define("MAP_SIZE_Y",10);
define("MAP_ONE_POLE_SPEED", 5); //в секундах

define("MAP_RESOURCE_CHANCE", 5); //в процентах
define("BATTLE_ARMY_MORE_COEFF", 20); //в процентах, на сколько будет сильнее армия при превосходящей численности

//Константы приложения
define("CLASS_DIR","/");


//@TODO переопределить юниты, сделать производство людей в ратуше, а юниты из людей будут получаться путем добовления различных орудий труда, например человек+меч=пехота, человек+меч+щит=мечник, человек+копье+лошадь=конный рыцарь, все это разные классы
$weapon_warehouse=new WeaponWarehouse(array(array("Knife",5),array("Sword",10),array("Bow",15),array("Mace",20),array("Gun",50)));
$armor_warehouse=new ArmorWarehouse(array(array("Shield",20),array("Helmet",10),array("Corslet",15),array("Shell",40),array("Gloves",5)));
$unit_warehouse=new UnitWarehouse(array(array("Archer",20,5),array("Berserk",50,1),array("Knight",40,2),array("Worker",5,20)));

