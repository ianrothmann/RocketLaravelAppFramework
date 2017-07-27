<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 12:50 PM
 */

namespace IanRothmann\RocketLaravelAppFramework\Facades;


use Illuminate\Support\Facades\Facade;

class Rocket extends Facade
{
    public static function getFacadeAccessor(){
        return 'rocket-app';
    }
}