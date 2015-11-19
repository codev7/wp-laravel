<?php
namespace CMV\Misc\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for \CMV\Misc\ACL . Underlying ACL instance is initialized with \Auth::user()
 * Class Access
 * @example Access::check(Project::first())
 * @package CMV\Misc\Facades
 */
class Access extends Facade
{
    protected static function getFacadeAccessor() { return 'access'; }
}