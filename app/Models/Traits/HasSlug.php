<?php
namespace CMV\Models\Traits;

/**
 * Sets unique `slug` property to the model during creation.
 * Class HasSlug
 * @package CMV\Models\Traits
 */
trait HasSlug {

    public static function bootHasSlug()
    {
        static::creating(function($project) {
            $initialSlug = str_slug($project->name);
            
            $slug = $initialSlug; $i = 0;
            while (static::where('slug', $slug)->count()) {
                $i++;
                $slug = "$initialSlug-$i";
            }
            $project->slug = $slug;
        });
    }

}