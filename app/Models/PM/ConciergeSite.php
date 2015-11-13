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
        'bitbucket_slug', // SLUG of the site in bitbucket for api sync purposes
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

    protected $fillable = [
        'url',
        'name'
    ];

    public static $types = ['wordpress','laravel'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('CMV\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function developer()
    {
        return $this->belongsTo('CMV\User','developer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectManager()
    {
        return $this->belongsTo('CMV\User','project_manager_id');
    }

    /**
     * @return mixed
     */
    public function toDos()
    {
        return $this->hasMany('CMV\Models\PM\ToDo','reference_id')
            ->where('reference_type', ToDo::REF_CONCIERGE);
    }

    /**
     * @return mixed
     */
    public function threads()
    {
        return $this->hasMany('CMV\Models\PM\Thread','reference_id')
            ->where('reference_type', Thread::REF_CONCIERGE);
    }

    /**
     * @return mixed
     */
    public function files()
    {
        return $this->hasMany('CMV\Models\PM\Thread','reference_id')
            ->where('reference_type', File::REF_CONCIERGE);
    }

    /**
     * Checks whether the concierge site has associated bitbucket repository
     * @return boolean
     */
    public function hasRepo()
    {
        return $this->bitbucket_slug && $this->bitbucket_slug != "0";
    }

}
