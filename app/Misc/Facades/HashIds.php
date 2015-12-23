<?php
namespace CMV\Misc\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Helper
 * Class Pivotal
 * @example Access::check(Project::first())
 * @package CMV\Misc\Facades
 */
class HashIds extends Facade
{
    protected static function getFacadeAccessor() { return 'hashids'; }
}