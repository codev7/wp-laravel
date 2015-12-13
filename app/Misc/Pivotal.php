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

        return json_decode($response->getBody()->getContents());

//            } catch (\Exception $e) {
//                if ($i == 0)
//                if ($i == 1) {
//                    $this->dispatch(new SendSlackMessage('Failed to create a PT project: ' . $name . ' Exception: ' . $e->getMessage()));
//                }
//            }
//        }
    }

    /**
     * @param $projectId
     * @param $title
     * @param $content
     * @return array|mixed|object
     */
    public function createStory($projectId, $title, $content)
    {
        $response = $this->client->request('POST', "projects/{$projectId}/stories", [
            'json' => ['name' => $title, 'description' => $content]
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