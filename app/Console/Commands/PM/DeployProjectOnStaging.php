<?php

namespace CMV\Console\Commands\PM;

use Illuminate\Console\Command;

class DeployProjectOnStaging extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:deploy {project_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deploy project on staging server.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $projectId = (int) $this->argument('project_id');
        $project = \CMV\Models\PM\Project::find($projectId);

        if(!$project) {
            $this->error("project #{$projectId} foes not exists");
            return;
        }
        
        $command = "envoy run deploy --subdomain={$project->subdomain} --repo={$project->git_url}";
        $this->info($command);
        $this->info(shell_exec($command));
    }
}
