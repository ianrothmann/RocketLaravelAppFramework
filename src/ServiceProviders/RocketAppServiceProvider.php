<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/04/12
 * Time: 12:52 PM
 */

namespace IanRothmann\RocketLaravelAppFramework\ServiceProviders;


use Blade;
use IanRothmann\RocketLaravelAppFramework\Language\RocketLanguage;
use Illuminate\Support\ServiceProvider;

class RocketAppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        RocketLanguage::register();
        $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        $this->publishes([
            __DIR__.'/../Config/rocketframework.php' => config_path('rocketframework.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__.'/../Views/', 'rocket');
    }

    public function register(){
        $this->app->bind('rocket-app','IanRothmann\RocketLaravelAppFramework\RocketLaravelAppFramework');
        $this->registerHelpers();
    }


    /**
     * Register helpers file
     */
    public function registerHelpers()
    {
        if (file_exists( __DIR__.DIRECTORY_SEPARATOR.'../helpers.php'))
        {
            require_once __DIR__.DIRECTORY_SEPARATOR.'../helpers.php';
        }
    }



}