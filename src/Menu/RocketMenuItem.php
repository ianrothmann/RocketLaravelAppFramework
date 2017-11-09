<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/07/25
 * Time: 11:16 AM
 */

namespace IanRothmann\RocketLaravelAppFramework;


class RocketMenuItem
{
    public $itemLabel, $itemHint, $itemLink, $itemIcon, $itemId, $itemTarget, $itemRight;
    public $subMenu;


    public function __construct($label){
        $this->label($label);
        $this->subMenu=new RocketMenu($this->itemId);
    }

    public function hint($value){
        $this->itemHint=$value;
        return $this;
    }

    public function label($value){
        $this->itemLabel=$value;
        return $this;
    }

    public function link($value){
        $this->itemLink=$value;
        return $this;
    }

    public function target($value){
        $this->itemTarget=$value;
        return $this;
    }

    public function route($name,$params=[]){
        $this->itemLink=route($name,$params);
        return $this;
    }

    public function icon($value){
        $this->itemIcon=$value;
        return $this;
    }

    public function right($rightOrClosure){
        $this->itemRight=$rightOrClosure;
        return $this;
    }

    public function id($value){
        $this->itemId=$value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemLabel()
    {
        return $this->itemLabel;
    }

    /**
     * @return mixed
     */
    public function getItemHint()
    {
        return $this->itemHint;
    }

    /**
     * @return mixed
     */
    public function getItemLink()
    {
        return $this->itemLink;
    }

    /**
     * @return mixed
     */
    public function getItemIcon()
    {
        return $this->itemIcon;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @return mixed
     */
    public function subMenu()
    {
        return $this->subMenu;
    }

    /**
     * @return mixed
     */
    public function getItemRight()
    {
        return $this->itemRight;
    }





}