<?php
namespace CMV\Misc\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Helper
 * Class Pivotal
 * @example Access::check(Project::first())
 * @package CMV\Misc\Facades
 */
class Pivotal extends Facade
{
    protected static function getFacadeAccessor() { return 'pivotal'; }
}