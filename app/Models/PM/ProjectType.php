<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

/**
* A project type is used to create a "starting point" for
* each project.  The bitbucket url is the URL to the repo
* that we will clone for the specific project type that is
* associated with the project. 
*/
class ProjectType extends Model {

	protected $columns = [
        'id',
        'name',
        'bitbucket_url',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'bitbucket_url',
    ];

    public static $defaults = [
        'psd_to_html_to_wordpress',
        'design_html_wordpress',
        'wordpress_theme',
        'wordpress_plugin',
        'psd_to_html',
        'psd_to_email',
        'javascript',
        'psd_to_html_and_javascript',
        'design',
        'psd_to_html_to_laravel',
        'design_html_laravel'
    ];


    public function projects()
    {

        return $this->hasMany( 'CMV\Models\PM\Project' );

    }

    public function scopeRandom($query)
    {
        return $query->orderBy(\DB::raw('RAND()'));
    }
}
