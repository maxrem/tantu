<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontendTest extends TestCase
{
    /**
     * Check if homepage works
     */
    public function testHome(): void
    {
        $response = $this->get('/');
        $response->assertSee('Tantu');
    }
}
