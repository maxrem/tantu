<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontendTest extends TestCase
{
    /**
     * Check if homepage works
     *
     * @return void
     */
    public function testHome()
    {
        $this->visit('/')
             ->see('Tantu');
    }

    /**
     * Check if form works
     *
     * @return void
     */
    public function testForm()
    {
        $this->visit('/')
             ->type(env('TWITTER_SEARCH_QUERY'), 'query')
             ->press('Submit')
             ->see('Results');
    }
}
