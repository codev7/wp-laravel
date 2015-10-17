<?php

namespace CMV\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Cache;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function minifyHTML($view)
    {


        if(isProduction())
        {
            return \HTMLMin::html($view);    
        }

        return $view;
    }


    /* Not in use yet - need to figure out best way to do this */
    protected function cacheView($view)
    {   

        $cacheKey = \Request::url();

        if(\Cache::has($cacheKey))
        {
            return \Cache::get($cacheKey);
        }


        Cache::forever($cacheKey, $view->render());

        return $view;
    }

}