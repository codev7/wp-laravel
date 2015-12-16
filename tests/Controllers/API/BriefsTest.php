<?php

class BriefsTest extends CMVTestCase {

    /**
     * @test
     */
    public function testMiddlewares()
    {
        $project = $this->project();
        $brief = $this->brief($project);

        $clientUris = [
            ['uri' => "/api/projects/{$project->id}/briefs", 'method' => 'GET'],
            ['uri' => "/api/projects/{$project->id}/briefs/{$brief->id}", 'method' => 'GET'],
            ['uri' => "/api/projects/{$project->id}/briefs/{$brief->id}/request-changes", 'method' => 'POST', 'data' => ['text' => 'do something']],
        ];

        $adminUris = [
            ['uri' => "/api/projects/{$project->id}/briefs", 'method' => 'POST', 'data' => ['brief' => ['brief_type' => 'wordpress']]],
            ['uri' => "/api/projects/{$project->id}/briefs/{$brief->id}", 'method' => 'PUT', 'data' => ['brief' => ['brief_type' => 'wordpress']]],
            ['uri' => "/api/projects/{$project->id}/briefs/{$brief->id}/approve", 'method' => 'POST'],
            ['uri' => "/api/projects/{$project->id}/briefs/{$brief->id}/send-to-client", 'method' => 'POST'],
        ];

        $this->assertRestUris(array_merge($clientUris, $adminUris), null, 400);
        $this->assertRestUris(array_slice($clientUris, 1, 2), $project->team->owner, 400);

        $brief->approved_by_admin_id = 1;
        $brief->save();
        $this->assertRestUris($clientUris, $project->team->owner, 200);
        $this->assertRestUris($adminUris, $project->team->owner, 400);

        $project->team->owner->is_admin = 1;
        $project->team->owner->save();
        $this->assertRestUris($adminUris, $project->team->owner, 200);
    }
}