<?php

namespace CMV\Models\PM;

use CMV\Jobs\SyncToDoWithPT;
use Illuminate\Database\Eloquent\Model;
use App, Config, Bugsnag, Exception;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * @todo Refactor ->reference() to ->project()
 * Customers can submit to-do items to their projects
 * as well as to any sites they have in Concierge service.
 * Each to-do will be automatically created as a task via
 * the PT API.
 *
 * Should have some caching mechanism for data pulled in from Bitbucket.
 */
class ToDo extends Model
{
    use DispatchesJobs;

    // accepted, delivered, finished, started, rejected, planned, unstarted, unscheduled
    const REF_PROJECT = 'project';
    const REF_CONCIERGE = 'concierge_site';

    const STATUS_NEW = 'unstarted';
    const STATUS_IN_WORK = 'started';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_REJECTED = 'rejected';
    const STATUS_ACCEPTED = 'accepted';

    protected $columns = [
        'id',
        'reference_id', //concierge_site_id || project_id
        'reference_type', //concierge_site || project
        'bitbucket_issue_id',
        'created_by_id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'content', 'title', 'category', 'type'
    ];

    public static function boot()
    {
        parent::boot();
    }

    /**
     * @return mixed
     */
    public function thread()
    {
        if (!$this->thread_id) {
            $thread = new Thread();
            $thread->reference_id = $this->id;
            $thread->reference_type = Thread::REF_TODO;
            $thread->save();
        }

        return $this->hasOne('CMV\Models\PM\Thread', 'reference_id')
            ->where('reference_type', Thread::REF_TODO);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->thread->messages();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reference()
    {
        switch ($this->reference_type) {
            case static::REF_PROJECT:
                return $this->belongsTo('\CMV\Models\PM\Project', 'reference_id');
            case static::REF_CONCIERGE:
                return $this->belongsTo('\CMV\Models\PM\ConciergeSite', 'reference_id');
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('CMV\User','created_by_id');
    }
}
