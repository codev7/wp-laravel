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
    protected $signature = 'pivotaltracker:import-from-basecamp
                            {--basecamp_project_id= : The ID of the project in Basecamp}
                            {--pivotal_tracker_project_id= : The ID of the project in PivotalTracker}
                            {--assigned_person_id=null : The ID of the Person in Basecamp}';

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

        $this->client = \Basecamp\BasecampClient::factory(array(
            'auth' => 'http',
            'username' => env('BASECAMP_USERNAME'),
            'password' => env('BASECAMP_PASSWORD'),
            'user_id' => env('BASECAMP_USER_ID'),
            'app_name' => env('BASECAMP_APP_NAME'),
            'app_contact' => env('BASECAMP_APP_CONTACT')
        ));

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
        $basecampAssignedPersonId = $this->option('assigned_person_id') ? intval($this->option('assigned_person_id')) : null;

        if($basecampAssignedPersonId)
            $this->info('Imports all of the to-dos assigned to person('.$basecampAssignedPersonId.') from a project('.$basecampProjectId.') in Basecamp into unique stories in a pivotal tracker project('.$pivotalProjectId.') ');
        else
            $this->info('Imports all of the to-dos from a project('.$basecampProjectId.') in Basecamp into unique stories in a pivotal tracker project('.$pivotalProjectId.')');

        $bcTodoLists = $this->getBasecampTodoLists($basecampProjectId, $basecampAssignedPersonId);
        $newStories = $this->convertTodoListsToStories($basecampProjectId,$bcTodoLists);
        $this->createOrUpdatePTStory($pivotalProjectId, $newStories);
    }


    /**
     * Get Basecamp TodoLists
     *
     * @param $bcProjectId
     * @param $bcAssignedPersonId
     * @return array|mixed
     */

    public function getBasecampTodoLists($bcProjectId, $bcAssignedPersonId=null){
        if($bcAssignedPersonId){
            $todoLists = $this->client->getAssignedTodolistsByPerson( array(
                'personId' => $bcAssignedPersonId
            ) );
            return $todoLists;
        }
        else{
            $todoLists = $this->client->getTodolistsByProject( array(
                'projectId' => $bcProjectId ,
            ) );
            return $todoLists;
        }
    }


    /**
     * Convert Basecamp Todolists array to Pivotal Tracker Stories array
     *
     * @param $bcProjectId
     * @param $bcTodoLists
     * @return array|mixed
     */

    public function convertTodoListsToStories($bcProjectId, $bcTodoLists){
        $ptStories = array();
        foreach ($bcTodoLists as $key => $value){

            $ptStories[] = array('id' => $value['id'], 'title' => $value['name'], 'content' => $value['description']);
        }
        return $ptStories;
    }

    /**
     * Create or Update Pivotal Tracker Stories
     *
     * @param $ptProjectId
     * @param $newStories
     */

    public function createOrUpdatePTStory($ptProjectId, $newStories){

        $pivotal = new Pivotal();
        foreach ($newStories as $key => $value){
            $response = $pivotal->getProjectStoriesWithLabel($ptProjectId, "bc-to-do-".$value['id']);
            if(count($response)){
                $story = $response[0];
                $data = [
                    'name' => $value['title'],
                    'description' => $value['content'],
                    'story_type' => 'feature',
                    'labels' => array('BC-TO-DO-'.$value['id']),
                    'estimate' => 2
                ];
                $pivotal->updateStory($ptProjectId, $story->id, $data);
            }
            else{
                $pivotal->createStory($ptProjectId, $value['title'], $value['content'],'feature',array('BC-TO-DO-'.$value['id']));
            }
        }
    }
}
