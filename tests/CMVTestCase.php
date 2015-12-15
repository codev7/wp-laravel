<?php

use CMV\User, CMV\Team;
use CMV\Models\PM\Project;

class CMVTestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /** @var  Faker\Generator */
    protected $fake;

    /** @var array  */
    protected $emails = [];

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        $this->fake = Faker\Factory::create();

        Mail::shouldReceive('send')
            ->andReturnUsing(function($template, $data) {
                $this->emails[] = ['template' => $template, 'data' => $data];
            });
    }

    /**
     * @before
     */
    public function runDBMigrations()
    {
        $this->artisan('migrate');

//        $this->artisan('db:seed', ['--class' => 'SomeSeeder']);
    }


    /**
     * Asserts all requests to uris end up in the certain destination
     * @param array $uris - e.g. ['/profile', '/billing', '/news/5']
     * @param User $user - be logged in as a user. NOTE: once any user is used it's impossible to log out during the one test function
     * @param $destination - resulting uri, equals uri in uris if null
     */
    protected function assertUris(array $uris, User $user = null, $destination = null)
    {
        foreach ($uris as $uri) {
            if ($user) $this->actingAs($user);

            $this->visit($uri);
            $this->seePageIs($destination ? $destination : $uri);
            $this->assertResponseStatus(200);
        }
    }

    /**
     * Asserts all provided uris return certain http response status
     * @param array $uris - e.g. [
     *  [
     *      [
     *          'uri' => '/profile', 'method' => 'PUT', 'data' => ['name' => John']
     *      ]
     *  ]
     *  By default method = 'GET' and 'data' = [].
     * @param User $user
     * @param int $responseStatus
     */
    protected function assertRestUris(array $uris, User $user = null, $responseStatus = 200)
    {
        if ($user) $this->actingAs($user);

        foreach ($uris as $params) {
            $uri = $params['uri'];
            $method = isset($params['method']) ? $params['method'] : 'GET';
            $data = isset($params['data']) ? $params['data'] : [];
            $this->json($method, $uri, $data, ['X-Requested-With' => 'XMLHttpRequest']);
            $this->assertResponseStatus($responseStatus);
        }
    }

    /**
     * @param array $structure
     */
    protected function assertJsonStructure(array $structure)
    {
        $json = $this->getResponseJson();

        $assert = function($structure, $json) use (&$assert) {
            foreach ($structure as $key => $value) {
                if (is_array($value)) {
                    $this->assertArrayHasKey($key, $json);
                    $assert($value, $json[$key]);
                } else {
                    $this->assertArrayHasKey($value, $json);
                }
            }
        };

        $assert($structure, $json);
    }

    /**
     * @return mixed
     */
    protected function getResponseJson()
    {
        $json = json_decode($this->response->getContent(), true);
        $this->assertTrue(is_array($json), 'Received json is not valid');

        return $json;
    }

    /**
     * @param array $fields
     */
    protected function assertHasValidationErrors(array $fields)
    {
        $errors = Session::get('errors')->toArray();

        foreach ($fields as $field) {
            $this->assertArrayHasKey($field, $errors);
        }
    }

    /**
     * @return Team
     */
    protected function teamWOwner()
    {
        $user = factory(CMV\User::class)->create();

        $team = Team::create(['name' => $this->fake->word]);
        $team->owner_id = $user->id;
        $team->save();

        $user->joinTeamById($team->id);
        $user->save();

        return $team;
    }

    /**
     * @return User
     */
    protected function admin()
    {
        return factory(CMV\User::class)->create(['is_admin' => true]);
    }

    /**
     * @return User
     */
    protected function mastermind()
    {
        return factory(CMV\User::class)->create(['is_mastermind' => true]);
    }

    /**
     * @param Team $team
     * @return Project
     */
    protected function project(Team $team = null)
    {
        if (!$team) $team = $this->teamWOwner();

        $project = factory(CMV\Models\PM\Project::class)->create([
            'team_id' => $team
        ]);

        return $project;
    }

}
