<?php

class NewsTest extends CMVTestCase {

    /**
     * @test
     */
    public function testMiddlewares()
    {
        $uris = [
            ['uri' => '/api/news/1/view', 'method' => 'POST']
        ];
        $this->assertRestUris($uris, null, 401);
        $this->assertRestUris($uris, $this->admin(), 200);
    }

}