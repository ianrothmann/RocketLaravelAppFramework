<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2018/03/26
 * Time: 12:14 PM
 */

namespace IanRothmann\RocketLaravelAppFramework\Breadcrumbs;


class BreadcrumbsService
{
    private $breadcrumbsNamespace;
    private $numberOfBreadcrumbs=4;
    private $shouldShowCurrent;
    private $defaultHidden=true;

    public function __construct()
    {
        if(\Config::has('rocketframework.breadcrumbs.number'))
            $this->numberOfBreadcrumbs=\Config::get('rocketframework.breadcrumbs.number');

        if(\Config::has('rocketframework.breadcrumbs.default')){
            $this->defaultHidden=\Config::get('rocketframework.breadcrumbs.default')=='hide';
        }
    }

    public function setBreadcrumbsNamespace($namespace){
        $this->breadcrumbsNamespace=$namespace;
    }

    public function setNumberOfBreadcrumbs($numberOfBreadcrumbs){
        $this->numberOfBreadcrumbs=$numberOfBreadcrumbs;
    }

    public function getNumberOfBreadcrumbs(){
        return $this->numberOfBreadcrumbs;
    }

    private function getBreadcrumbsFromSession(){
        $breadcrumbs=session()->get('rocket_breadcrumbs_'.$this->breadcrumbsNamespace);
        if(!$breadcrumbs || !is_array($breadcrumbs)){
            $breadcrumbs=[];
            session()->put('rocket_breadcrumbs_'.$this->breadcrumbsNamespace,$breadcrumbs);
        }
        if(sizeof($breadcrumbs)>$this->numberOfBreadcrumbs){
            array_shift($breadcrumbs);
        }
        return $breadcrumbs;
    }

    private function setBreadcrumbsInSession($breadcrumbs){
        if(!$breadcrumbs || !is_array($breadcrumbs)) {
            $breadcrumbs = [];
        }
        session()->put('rocket_breadcrumbs_'.$this->breadcrumbsNamespace,$breadcrumbs);
    }

    public function addBreadcrumb($name,$url=null){
        if($url===null){
            $url=url()->current();
        }
        $breadcrumbs=$this->getBreadcrumbsFromSession();
        $key=md5($url);
        if(!array_key_exists($key,$breadcrumbs)){
            $breadcrumbs[$key]=['name'=>$name,'url'=>$url];
            if(sizeof($breadcrumbs)>2*$this->numberOfBreadcrumbs){
                array_shift($breadcrumbs);
            }
            $this->setBreadcrumbsInSession($breadcrumbs);
        }

    }

    public function getBreadcrumbs(){
        return $this->getBreadcrumbsFromSession();
    }

    public function clearBreadcrumbs(){
        $this->setBreadcrumbsInSession([]);
    }

    public function showByDefault(){
        $this->defaultHidden=false;
    }

    public function hideByDefault(){
        $this->defaultHidden=true;
    }

    public function show(){
        $this->shouldShowCurrent=true;
    }

    public function hide(){
        $this->shouldShowCurrent=false;
    }

    public function shouldBreadcrumbsBeDisplayedForCurrentRoute(){
        return ($this->shouldShowCurrent===null&&!$this->defaultHidden) || $this->shouldShowCurrent;
    }
}