<?php
Route::post(config('rocketframework.language.url'),'IanRothmann\RocketLaravelAppFramework\Language\RocketLanguage@save')
    ->middleware(config('rocketframework.language.middleware'))
    ->name(config('rocketframework.language.routename'));
