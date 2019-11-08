<?php
namespace App\Http\ViewComposers;

use Route;

class ViewComposer
{
    public function compose($view)
    {
        $currentRoute = Route::current();
        $routeName    = Route::currentRouteName();
        $routeAction  = Route::currentRouteAction();
        $prefix       = !empty($currentRoute->action) ? $currentRoute->action : null;
        $prefix       = !empty($prefix) ? explode('/', $prefix['prefix']) : null;

        $view->with('currentRoute', $currentRoute)
             ->with('routeName', $routeName)
             ->with('routeAction', $routeAction)
             ->with('prefix', $prefix);
    }
}
