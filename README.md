# RocketLaravelAppFramework
RocketFramework for Vue Laravel Helpers.

## Installation 

```php
composer install ianrothmann/rocket-laravel-framework
```
In config/app.php

Service provider 
```php
IanRothmann\RocketLaravelAppFramework\ServiceProviders\RocketAppServiceProvider::class
```

Facades
```php
'Rocket' =>IanRothmann\RocketLaravelAppFramework\Facades\Rocket::class
```

Publish the config

```php
php artisan vendor:publish --provider="IanRothmann\RocketLaravelAppFramework\ServiceProviders\RocketAppServiceProvider"  --tag="config"
```

## Menus
Menus can be specified in middleware, but can also be modified in any controller before passing the view.

### Usage
You can give the menu a name, for instance "main", and then chain the items. The icon is optional. If you need a custom item, you can use `->custom`

```php
Rocket::menu('main')
        ->route(label,routeName,paramsArray,icon)
        ->route('Change Password','password.change')
        ->link(name,url,icon) 
        ->custom(RocketMenu::item("Google")->link("http://google.com")->hint('Go to Google')->icon('delete')->id('google')->target('_blank'));
```

Groups are also possible. Specify `->group`. This returns the item. Then specify `->subMenu()`, and now you can chain the items to the submenu. You need to start with `Rocket::menu('main')` again to add main menu items.

```php
 Rocket::menu('main')
            ->group('Rocket CRUD')
            ->subMenu()
            ->route('CRUD Table','rocket.crud.table');
            
 Rocket::menu('main')->route('Home','home',[]);
```
### Prepending
Sometimes one would like to prepend items (especially when modifying middleware defined menus from the controller. All item functions can start with `push` to prepend.

```php
   Rocket::menu('main')->pushRoute('Home','home',[]); //pushLink, pushGroup, pushCustom etc.
```

### Front-end

This package integrates with VueBridge and makes the menu available in `$store.state.server.rocketMenus`, for use with `rocket-framework-menu` in `RocketVueAppFramework`:

```php
<rocket-framework-menu :menu="$store.state.server.rocketMenus&&$store.state.server.rocketMenus.main"></rocket-framework-menu>
```

## Edit in place language
This enables you to use blade syntax `@editabletext(language_line_code)` or `@editablehtml(language_line_code)`. If edit mode is active, a user will be able to edit the text in place. This is useful for public facing websites etc.

* Use `Rocket::activateLanguageEdit()` or `Rocket::deactivateLanguageEdit()` to enter edit mode.
* There are language configurations in app/config/rocketframework.php - mostly for the update routing. The defaults should do in most cases. - but remember the middleware for route protection. The default is [], but is should have auth and rights.
* It used the spatie/laravel-translation-loader package to store it in a `language_lines` table, make sure the table exists - for more info look at their readme.

