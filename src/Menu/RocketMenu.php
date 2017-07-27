<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/07/25
 * Time: 9:59 AM
 */

namespace IanRothmann\RocketLaravelAppFramework;


class RocketMenu
{

    public $items=[];
    private $idcnt=0;
    public $menuName;

    /**
     * RocketMenu constructor.
     * @param $menuName
     */
    public function __construct($menuName)
    {
        $this->menuName = $menuName;
    }

    private function makeId($id){
        return $this->menuName.'_'.$id;
    }

    public function route($label,$routeName,$params=[],$icon=null){
        $this->items[$this->makeId($this->idcnt)]=RocketMenu::item($label)
            ->route($routeName,$params)
            ->icon($icon)
            ->id($this->idcnt);
        $this->idcnt++;
        return $this;
    }


    public function link($label,$link,$icon=null){
        $this->items[$this->makeId($this->idcnt)]=RocketMenu::item($label)
                        ->link($link)
                        ->icon($icon)
                        ->id($this->idcnt);
        $this->idcnt++;

        return $this;
    }


    public function custom(RocketMenuItem $rocketMenuItem){
        if($rocketMenuItem->getItemId()===null)
            $rocketMenuItem->id($this->idcnt);

        $this->items[$this->makeId($rocketMenuItem->getItemId())]=$rocketMenuItem;

        $this->idcnt++;

        return $this;
    }

    /**
     * @param $label
     * @param null $icon
     * @return RocketMenuItem
     */
    public function group($label,$icon=null){
        $this->items[$this->makeId($this->idcnt)]=RocketMenu::item($label)
            ->icon($icon)
            ->id($this->makeId($this->idcnt));
        $oldid=$this->makeId($this->idcnt);
        $this->idcnt++;
        return $this->items[$oldid];
    }

    public function pushRoute($label,$routeName,$params=[],$icon=null){
        $temp=[];
        $temp[$this->makeId($this->idcnt)]=RocketMenu::item($label)
            ->route($routeName,$params)
            ->icon($icon)
            ->id($this->idcnt);
        $this->idcnt++;
        $this->items=$temp+$this->items;
        return $this;
    }


    public function pushLink($label,$link,$icon=null){
        $temp=[];
        $temp[$this->makeId($this->idcnt)]=RocketMenu::item($label)
            ->link($link)
            ->icon($icon)
            ->id($this->idcnt);
        $this->idcnt++;
        $this->items=$temp+$this->items;
        return $this;
    }


    public function pushCustom(RocketMenuItem $rocketMenuItem){
        if($rocketMenuItem->getItemId()===null)
            $rocketMenuItem->id($this->idcnt);

        $temp=[];
        $temp[$this->makeId($rocketMenuItem->getItemId())]=$rocketMenuItem;

        $this->idcnt++;
        $this->items=$temp+$this->items;
        return $this;
    }

    /**
     * @param $label
     * @param null $icon
     * @return RocketMenuItem
     */
    public function pushGroup($label,$icon=null){
        $temp=[];
        $temp[$this->makeId($this->idcnt)]=RocketMenu::item($label)
            ->icon($icon)
            ->id($this->makeId($this->idcnt));
        $oldid=$this->makeId($this->idcnt);
        $this->idcnt++;
        $this->items=$temp+$this->items;
        return $this->items[$oldid];
    }

    /**
     * @param $label
     * @return RocketMenuItem
     */
    public static function item($label){
        return new RocketMenuItem($label);
    }

}