<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

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

    protected $defaults = [
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

        return $this->hasMany( 'Project' );

    }

}
