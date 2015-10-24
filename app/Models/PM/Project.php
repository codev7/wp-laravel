<?php 

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* This model holds all data that pertains to the projects
* that are created by teams in the system.
*/
class Project extends Model {

	use SoftDeletes;
    
    protected $columns = [
        'id',
        'files', //json encoded array ['name' => $fileName, 'url' => $fileUrl, 'uploaded_by' => $user_id, 'date_uploaded' => $date_uploaded, 'deleted' => false]
        'project_type_id',
        'developer_id',
        'project_manager_id',
        'git_url', //the ssh url for the git repo on bitbucket
        'bitbucket_id', //bitbucket ID of the project for API purposes
        'team_id',
        'name', //unique name of project
        'slug', //unique
        'requested_deadline',
        'guaranteed_deadline',
        'status',
        'subdomain', //for the staging site   {subdomain}.approvemyviews.com - these staging sites will be autodeployed based off of git_url field
        'contractor_payout', //wont use for now - for future use
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'project_type_id',
        'git_url',
        'name',
        'requested_deadline',
        'status'
    ];

    protected $dates = [
        'guaranteed_deadline',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $statuses = [
        'quote',
        'brief',
        'approval',
        'development',
        'qa',
        'complete'
    ];

    public static $requestedDeadlineOptions = [
        'asap',
        'this_week',
        'next_week',
        'next_month',
        'not_sure'
    ];

    public function team()
    {

        return $this->belongsTo( 'CMV\Team', 'team_id' );

    }

    public function members()
    {
        return $this->hasManyThrough('CMV\User','CMV\Team');
    }

    public function developer()
    {

        return $this->belongsTo( 'CMV\User', 'developer_id' );

    }

    public function projectManager()
    {
        return $this->belongsTo('CMV\User', 'project_manager_id');
    }

    public function type()
    {

        return $this->belongsTo( 'CMV\Models\PM\ProjectType','project_type_id' );

    }

    public function briefs()
    {
        return $this->hasMany('CMV\Models\PM\ProjectBrief');
    }

    public function invoices()
    {

        return $this->hasMany( 'CMV\Models\PM\Invoice','reference_id');

    }

    public function toDos()
    {
        return $this->hasMany('CMV\Models\PM\ToDo','reference_id');
    }

    public function messages()
    {
        return $this->hasMany('CMV\Models\PM\Message','reference_id');
    }

    public function createOrFindProjectTypeId($projectTypeName)
    {

        $projectType = ProjectType::firstOrCreate(['name' => $projectTypeName]);

        $this->project_type_id = $projectType->id;
        $this->save();
        
    }
}
