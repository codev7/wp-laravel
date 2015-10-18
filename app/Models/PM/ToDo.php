<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;

/**
* Customers can submit to-do items to their projects
* as well as to any sites they have in Concierge service.
* Each to-do will be automatically created as a task via
* the bitbucket API.
*
* Should have some caching mechanism for data pulled in from Bitbucket.
*/
class ToDo extends Model
{
    protected $columns = [
        'id',
        'reference_id', //concierge_site_id || project_id
        'reference_type', //concierge_site || project
        'bitbucket_issue_id',
        'created_by_id',
        'created_at',
        'updated_at'
    ];

    public function conciergeSite()
    {
        return $this->belongsTo('CMV\Models\PM\ConciergeSite','reference_id');
    }

    public function project()
    {
        return $this->belongsTo('CMV\Models\PM\Project','reference_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('CMV\User','created_by_id');
    }
}
