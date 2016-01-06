<?php

namespace CMV\Console\Commands;

use Illuminate\Console\Command;
use Basecamp\BasecampClient;
use Doctrine\Common\Cache\FilesystemCache;
use Guzzle\Cache\DoctrineCacheAdapter;
use Guzzle\Plugin\Cache\CachePlugin;
use CMV\Misc\Pivotal;

class PivotalTrackerImportFromBasecamp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pivotaltracker:import-from-basecamp {--basecamp_project_id= : The ID of the project in Basecamp} {--pivotal_tracker_project_id= : The ID of the project in PivotalTracker}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports all of the to-dos from a specific project in Basecamp into unique stories in a pivotal tracker project';


    /**
     * Create a new command instance.
     *
     *
     */

    public function __construct()
    {

        parent::__construct();


        $cachePlugin = new CachePlugin(array(
            'adapter' => new DoctrineCacheAdapter(new FilesystemCache(__DIR__.'/../../../storage/app/cache/basecamp'))
        ));
        $this->client = \Basecamp\BasecampClient::factory(array(
            'auth' => 'http',
            'username' => 'caking719@gmail.com',
            'password' => 'pass123456789',
            'user_id' => 3196846,
            'app_name' => 'Codemyview Test for api',
            'app_contact' => 'caking719@gmail.com'
        ));
        $this->client->addSubscriber($cachePlugin);

    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        $basecampProjectId = intval($this->option('basecamp_project_id'));
        $pivotalProjectId = intval($this->option('pivotal_tracker_project_id'));
        $this->info('Imports all of the to-dos from a specific project {'.$basecampProjectId.'} in Basecamp into unique stories in a pivotal tracker project {'.$pivotalProjectId.'}');

        $bcTodoLists = $this->getBasecampTodoList($basecampProjectId);

        $newStories = $this->convertTodoListsToStories($bcTodoLists);
        $this->updatePTStory($pivotalProjectId, $newStories);
    }


    /**
     * @param $bcProjectId
     * @return array|mixed
     */

    Public function getBasecampTodoList($bcProjectId){
        $response = $this->client->getTodolistsByProject( array(
            'projectId' => $bcProjectId ,
        ) );
        return $response;
    }


    /**
     * Convert
     *
     * @param $bcTodoLists
     * @return array|mixed
     */

    Public function convertTodoListsToStories($bcTodoLists){
        $ptStories = array();
        foreach ($bcTodoLists as $key => $value){
            $ptStories[] = array('title' => $value['name'], 'content' => $value['description']);
        }
        return $ptStories;
    }


    /**
     * Convert
     *
     * @param $ptProjectId
     * @param $newStories
     */

    Public function updatePTStory($ptProjectId, $newStories){

        $pivotal = new Pivotal();
        foreach ($newStories as $key => $value){
            $content = $pivotal->createStory($ptProjectId, $value['title'], $value['content']);
        }
    }
}
