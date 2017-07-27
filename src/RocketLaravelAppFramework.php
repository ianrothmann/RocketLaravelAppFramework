<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/07/25
 * Time: 10:05 AM
 */

namespace IanRothmann\RocketLaravelAppFramework;


use VueBridge;

class RocketLaravelAppFramework
{
    /** @var RocketMenu[] $menus
     */
    public $menus=[];

    public function __construct(){
        $self=$this;
        VueBridge::exposeClosureResult('rocketMenus',function() use ($self){
           return $self->getMenus();
        });
    }

    public function menu($id){
        if(!array_key_exists($id,$this->menus))
            $this->menus[$id]=new RocketMenu($id);

        return $this->menus[$id];
    }

    public function getMenus(){
        return $this->menus;
    }
}