<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kogtev_k
 * Date: 07.06.13
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */

class ErrorBattleException extends Exception {};

class City extends MapPoint {
    private $CityArmy;
    private $Buildings = array();

    //@TODO сделать отдельный класс для управления ресурсами в городе или абстрактный класс РЕСУРС и субклассы от него
    private $city_resource = null; // new CityResource()
    private $Food=400;
    private $Wood=400;
    private $Stones=400;
    private $Steel=400;

    //вспомогательные переменные
    private $wave_count=0;

    function __construct($x, $y){
        parent::setPoint($x, $y);
        $this->CityArmy=new Army();
    }

    function __toString(){
        return "9"; //отображаем на карте
    }

    function getArmy(){
        return $this->CityArmy;
    }

    function battle(Army $attack_army)
    {
        $this->getArmy()->prepareForBattle();
        $attack_army->prepareForBattle();
        $this->wave_count=0;

        try{ //@TODO уточнить правильность обработки исключения
           if (!$this->attackWaves($attack_army)) throw new ErrorBattleException("Ошибка проведения сражения!");
            $this->CityArmy->checkDead();
            $attack_army->checkDead();
        } catch(Exception $e){echo $e->getMessage();}
        return $this->wave_count;
    }

    private function attackWaves(Army $attack_army){ //рекурсивная внутренная функция для обсчета волн атаки
        $this->wave_count++;

        //высчитываем среднюю силу удара атакующей и защищающейся армии и коэффицент чтобы один юнит не нанес повреждения десяти
        $attack_army_strength=0;
        $defence_army_strength=0;
        $coeff=(count($this->getArmy()->getUnits())/count($attack_army->getUnits()));
        foreach($attack_army->getUnits() as $unit) $attack_army_strength+=$unit->getAttackStrength();
        foreach($this->getArmy()->getUnits() as $unit) $defence_army_strength+=$unit->getAttackStrength();
        $attack_army_strength=$attack_army_strength/count($attack_army->getUnits());
        $defence_army_strength=$defence_army_strength/count($this->getArmy()->getUnits());

        //наносим повреждения юнитам в обоих армиях и проверяем мертвых
        $this->getArmy()->setDamage($attack_army_strength/$coeff); //@TODO не учтено кол-во войск в разных армиях, например один юнит может нанести повреждения сразу трем, а три ему нанесут повреждения как один. Возможно стоит считать коэф не средний, а общую силу удара делить на кол-во юнитов в другой армии
        $attack_army->setDamage($defence_army_strength*$coeff);

        //если в одной из армий еще есть живые начинаем все заного
        if ($this->getArmy()->checkDead()&&$attack_army->checkDead())
            $this->attackWaves($attack_army);
        return true;
    }
}