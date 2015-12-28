<?php 

namespace CMV\Models\PM;

use CMV\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Event;

/**
* This model holds all data that pertains to the projects
* that are created by teams in the system.
*/
class Project extends Model {

	use SoftDeletes, HasSlug;

    const STATUS_QUOTE = 'quote';
    const STATUS_BRIEF = 'brief';
    const STATUS_DEVELOPMENT = 'development';
    const STATUS_QA = 'qa';
    const STATUS_APPROVAL = 'approval';
    const STATUS_COMPLETE = 'complete';

    protected $columns = [
        'id',
        'files', //json encoded array ['name' => $fileName, 'url' => $fileUrl, 'uploaded_by' => $user_id, 'date_uploaded' => $date_uploaded, 'deleted' => false]
        'project_type_id',
        'developer_id',
        'project_manager_id',
        'git_url', //the ssh url for the git repo on bitbucket
        'bitbucket_slug', //bitbucket SLUG of the project for API purposes
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
        'status',
        'project_manager_id'
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

    public static function boot()
    {
        parent::boot();

        self::updating(function(Project $project) {
            $dirty = $project->getDirty();
            if (isset($dirty['developer_id']) && $dirty['developer_id']) {
                Event::fire('project.developer-assigned', $project);
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {

        return $this->belongsTo( 'CMV\Team', 'team_id' );

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function members()
    {
        return $this->hasManyThrough('CMV\User','CMV\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function developer()
    {
        return $this->belongsTo( 'CMV\User', 'developer_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectManager()
    {
        return $this->belongsTo('CMV\User', 'project_manager_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo( 'CMV\Models\PM\ProjectType','project_type_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function briefs()
    {
        return $this->hasMany('CMV\Models\PM\ProjectBrief');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany( 'CMV\Models\PM\Invoice','reference_id');
    }

    /**
     * @return mixed
     */
    public function toDos()
    {
        return $this->hasMany('CMV\Models\PM\ToDo','reference_id')
            ->where('reference_type', ToDo::REF_PROJECT);
    }

    /**
     * @return mixed
     */
    public function threads()
    {
        return $this->hasMany('CMV\Models\PM\Thread','reference_id')
            ->where('reference_type', Thread::REF_PROJECT);
    }

    /**
     * @return mixed
     */
    public function files()
    {
        return $this->hasMany('CMV\Models\PM\File','reference_id')
            ->where('reference_type', File::REF_PROJECT);
    }

    /**
     * @param $projectTypeName
     */
    public function createOrFindProjectTypeId($projectTypeName)
    {
        $projectType = ProjectType::firstOrCreate(['name' => $projectTypeName]);

        $this->project_type_id = $projectType->id;
        $this->save();
    }

    public function getStagingUrl()
    {

        if($this->subdomain) return 'http://'.$this->subdomain.'.approvemyviews.com';


        return false;
    }

    /**
     * Checks whether the project has associated bitbucket repository
     * @return boolean
     */
    public function hasRepo()
    {
        return $this->bitbucket_slug && $this->bitbucket_slug != "0";
    }

    /**
     * Gives status of the project for humans
     * @return string
     */
    public function getStatus()
    {
        switch ($this->status) {
            case (static::STATUS_QUOTE):
                return "Hang tight! We are preparing a project estimate for you.";
            case (static::STATUS_BRIEF):
                return "We are currently preparing the project brief.";
            case (static::STATUS_DEVELOPMENT):
                return "Your project is in development.";
            case (static::STATUS_QA):
                return "Your project is being QAed.";
            case static::STATUS_APPROVAL:
                return "We are waiting for your approval on the development brief.";
            case static::STATUS_COMPLETE:
                return "Your project is complete.";
            default:
                return 'Unknown status';
        }
    }
}
