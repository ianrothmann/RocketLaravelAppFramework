<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/07/25
 * Time: 10:05 AM
 */

namespace IanRothmann\RocketLaravelAppFramework;


use IanRothmann\RocketLaravelAppFramework\Breadcrumbs\BreadcrumbsService;
use IanRothmann\RocketLaravelAppFramework\Language\RocketLanguage;
use IanRothmann\RocketLaravelAppFramework\Menu\RocketMenu;
use VueBridge;

class RocketLaravelAppFramework
{
    /** @var RocketMenu[] $menus
     */
    public $menus=[];
    public $language;
    public $breadcrumbsService;

    public function __construct(){
        $self=$this;
        VueBridge::exposeClosureResult('rocketMenus',function() use ($self){
           return $self->getMenus();
        });
        $this->language=new RocketLanguage();
        $this->breadcrumbsService=new BreadcrumbsService();
    }

    public function menu($id){
        if(!array_key_exists($id,$this->menus))
            $this->menus[$id]=new RocketMenu($id);

        return $this->menus[$id];
    }

    public function getMenus(){
        foreach($this->menus as &$menu){
            //$menu->c
        }
        return $this->menus;
    }

    /**
     * @return BreadcrumbsService
     */
    public function breadcrumbs(){
        return $this->breadcrumbsService;
    }

    public function activateLanguageEdit(){
        $this->language->activateEditMode();
    }

    public function deactivateLanguageEdit(){
        $this->language->deactivateEditMode();
    }

    public function isInLanguageEditMode(){
        return $this->language->isInEditMode();
    }
}