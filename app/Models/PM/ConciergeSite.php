<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The model is used to hold Concierge Site object data and methods.
 * Customers can subscribe to a monthly plan that gives them the ability
 * to add a "Concierge Site".  a Concierge Site gives the customer the ability
 * to submit tasks to be completed on their site.  Concierge customers also get
 * uptime guarantees, and unlimited bug fixes on their sites for a monthly fee.
 */
class ConciergeSite extends Model
{   
    use SoftDeletes;

    protected $columns = [
        'id',
        'files',
        'type', //wordpress || laravel  (default wordpress)
        'developer_id',
        'project_manager_id',
        'bitbucket_id', //id of the site in bitbucket for api sync purposes
        'git_url', //ssh url of the git repo for the site
        'team_id',
        'name',
        'slug',
        'url',
        'saved_credentials', //I am thinking this will be an encrypted text field where we can store shared credential information
        'status', //statuses TBD
        'subdomain', //subdomain for the staging site {subdomain}.concierge.approvemyviews.com
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $types = ['wordpress','laravel'];

    public function team()
    {

        return $this->belongsTo('CMV\Team');

    }


    public function developer()
    {
        return $this->belongsTo('CMV\User','developer_id');
    }

    public function projectManager()
    {
        return $this->belongsTo('CMV\User','project_manager_id');
    }

    public function toDos()
    {
        return $this->hasMany('CMV\Models\PM\ToDo','reference_id');
    }

    public function messages()
    {
        return $this->hasMany('CMV\Models\PM\Message','reference_id');
    }


}
