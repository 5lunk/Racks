<?php

namespace Tests\Feature\Http\Controllers\SiteControllers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class GetSiteControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/site';

    public $now;

    protected function afterRefreshingDatabase(): void
    {
        $this->now = CarbonImmutable::now()->micro(0);
        Carbon::setTestNow($this->now);
        $this->artisan('db:seed');
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow(null);
    }

    public function test_retrieveSite(): void
    {
        $this->json('GET', $this->path.'/1')
            ->assertStatus(200)
            ->assertJson(['data' => [
                'id' => 1,
                'name' => 'Test site',
                'description' => 'Main site',
                'updated_by' => 'tester',
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }

    public function test_noSuchSite(): void
    {
        $this->json('GET', $this->path.'/6')
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such site',
            ]]);
    }
}
