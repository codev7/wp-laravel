<?php

namespace CMV\Jobs\PM;

use CMV\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateRepoForProject extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /** @var integer project id */
    protected $projectId;

    /**
     * Create a new job instance.
     * 
     * @param integer $projectId project id
     * @return void
     */
    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info("CreateRepoForProject");
        \Log::info("Going to create bitbucket repository for project {$this->projectId}");

        $project = \CMV\Models\PM\Project::find($this->projectId);
        if(!$project) {
            \Log::error("No project #{$this->projectId} found");
            return false;
        }

        if($project->hasRepo()) {
            \Log::error("Project #{$project->id} already has repo. Slug is '{$project->bitbucket_slug}'");
            return false;
        }

        $accountName = \Config::get('services.bitbucket.accname');
        \Log::info("Try to create repo '{$project->slug}' for account '{$accountName}'");
        
        $resource = \App::make('Bitbucket')->api('Repositories\Repository');
        $response = $resource->create($accountName, $project->slug, array(
            'scm'               => 'git',
            'description'       => $project->name,
            'language'          => 'php',
            'is_private'        => true,
            'fork_policy'       => 'no_public_forks',
        ));
        $content = json_decode($response->getContent());

        if($response->isOk()) {
            \Log::info("Repository '{$content->slug}' created.");
            $project->git_url = "ssh@bitbucket.org/{$accountName}/{$content->slug}";
            $project->bitbucket_slug = $content->slug;
            $project->save();
        } else {
            \Log::error(json_encode($content));
            if($content->error->message === 'Repository already exists.') {
                $project->slug .= "-" . date('YmdHis');
                $project->save();
                $this->release();
            }
        }
    }
}
