<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 12:52 PM
 */

namespace IanRothmann\RocketLaravelAppFramework\ServiceProviders;


use Illuminate\Support\ServiceProvider;

class RocketAppServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('rocket-app','IanRothmann\RocketLaravelAppFramework\RocketLaravelAppFramework');
    }


}