<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\SiteControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateSiteControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/site';

    public $now;

    public $firstUser;

    public $secondUser;

    protected function afterRefreshingDatabase(): void
    {
        $this->now = CarbonImmutable::now()->micro(0);
        Carbon::setTestNow($this->now);
        $this->artisan('db:seed');
        $this->firstUser = User::where(['name' => 'first_user'])->first();
        $this->secondUser = User::where(['name' => 'second_user'])->first();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow(null);
    }

    public function test_noSuchSite(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/3', [
                'name' => 'some name',
            ])
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such site',
            ]]);
    }

    public function test_permissionException(): void
    {
        $this->be($this->secondUser)
            ->json('PATCH', $this->path.'/1')
            ->assertStatus(403)
            ->assertJson(['data' => [
                'message' => 'Action not allowed for this department',
            ]]);
    }

    public function test_siteUpdated(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/1', [
                'description' => 'some description',
            ])
            ->assertStatus(202)
            ->assertJson(['data' => [
                'id' => 1,
                'name' => 'Test site',
                'description' => 'some description',
                'department_id' => 1,
                'updated_by' => 'first_user',
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}
