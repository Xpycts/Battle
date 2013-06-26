<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 07.06.13
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */

abstract class MapPoint {
    private $x, $y;

    function __construct($x, $y){
        $this->setPoint($x, $y);
    }

    function setPoint($x, $y){
        $this->x=$x;
        $this->y=$y;
    }

    function getPoint(){
        return array($this->x, $this->y);
    }

    function get_X(){
        return $this->x;
    }

    function get_Y(){
        return $this->y;
    }

}


