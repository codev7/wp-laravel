<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use App, Config, Bugsnag, Exception;
use Carbon\Carbon;

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
    const REF_PROJECT = 'project';
    const REF_CONCIERGE = 'concierge_site';

    protected $columns = [
        'id',
        'reference_id', //concierge_site_id || project_id
        'reference_type', //concierge_site || project
        'bitbucket_issue_id',
        'created_by_id',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function($todo) {
            if (!$todo->bitbucket_issue_id && $todo->project->hasRepo()) {
                $bb = App::make('Bitbucket');
                $resource = $bb->api('Repositories\Issues');
                try {
                    $response = $resource->create(
                        Config::get('services.bitbucket.accname'),
                        $todo->project->bitbucket_slug, [
                            'title' => $todo->title,
                            'content' => $todo->content,
                            'kind' => 'task',
                            'priority' => 'major'
                        ]
                    );
                    $content = json_decode($response->getContent());
                    $todo->bitbucket_issue_id = $content->local_id;
                    $todo->save();
                } catch (Exception $e) {
                    Bugsnag::notifyException($e);
                }
            }
        });
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasOne('CMV\Models\PM\Thread')
            ->where('reference_type', Thread::REF_TODO);
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
