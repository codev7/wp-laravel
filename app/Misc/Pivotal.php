<?php
namespace CMV\Misc;

use CMV\Jobs\SendSlackMessage;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class Pivotal
 * @package CMV\Misc
 */
class Pivotal {

    use DispatchesJobs;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.pivotaltracker.com/services/v5/',
            'headers' => [
                'X-TrackerToken' => env('PIVOTAL_TOKEN')
            ]
        ]);
    }

    /**
     * @param $name
     * @return array|mixed|object
     */
    public function createProject($name)
    {
        $response = $this->client->request('POST', "projects", [
            'json' => ['name' => $name]
        ]);
        $project = json_decode($response->getBody()->getContents());

        $this->createProjectWebhook($project->id, env('APP_URL') . '/webhooks/pivotal');

        foreach (['wordpress', 'frontend', 'other'] as $label) {
            $this->createProjectLabel($project->id, $label);
        }

        return $project;
    }

    /**
     * @param $ptProjectId
     * @param $url
     */
    public function createProjectWebhook($ptProjectId, $url)
    {
        $response = $this->client->request('POST', "projects/{$ptProjectId}/webhooks", [
            'json' => [
                'webhook_url' => $url,
                'webhook_version' => 'v5'
            ]
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param $ptProjectId
     * @param $label
     */
    public function createProjectLabel($ptProjectId, $label)
    {
        $response = $this->client->request('POST', "projects/{$ptProjectId}/labels", [
            'json' => [
                'name' => $label
            ]
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param $projectId
     * @param $title
     * @param $content
     * @return array|mixed|object
     */
    public function createStory($projectId, $title, $content, $type = 'feature', array $labels = [])
    {
        $payload = [
            'name' => $title,
            'description' => $content,
            'story_type' => $type,
            'labels' => $labels
        ];

        // features need to be estimated to allow a status update
        if ($type == 'feature') $payload['estimate'] = 2;

        $response = $this->client->request('POST', "projects/{$projectId}/stories", [
            'json' => $payload
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @param $storyId
     * @param array $data
     * @return array|mixed|object
     */
    public function updateStory($projectId, $storyId, array $data)
    {
        $response = $this->client->request('PUT', "projects/{$projectId}/stories/{$storyId}", [
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @param $storyId
     * @param $content
     * @return array|mixed|object
     */
    public function createComment($projectId, $storyId, $content)
    {
        $response = $this->client->request('POST', "projects/{$projectId}/stories/{$storyId}/comments", [
            'json' => ['text' => $content]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @param $storyId
     * @return object
     */
    public function getStory($projectId, $storyId)
    {
        $response = $this->client->request('GET', "projects/{$projectId}/stories/{$storyId}");

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @param $storyId
     * @return object
     */
    public function getComments($projectId, $storyId)
    {
        $response = $this->client->request('GET', "projects/{$projectId}/stories/{$storyId}/comments");

        return json_decode($response->getBody()->getContents());
    }

}