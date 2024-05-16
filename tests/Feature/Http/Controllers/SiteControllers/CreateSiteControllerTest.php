<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\SiteControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateSiteControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/site'; // @phpstan-ignore-line

    public $now; // @phpstan-ignore-line

    public $firstUser; // @phpstan-ignore-line

    public $secondUser; // @phpstan-ignore-line

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

    public function test_noSuchDepartment(): void
    {
        $this->be($this->firstUser)
            ->json('POST', $this->path, [
                'department_id' => 5,
                'name' => 'some name',
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'No such department',
            ]]);
    }

    public function test_permissionException(): void
    {
        $this->be($this->secondUser)
            ->json('POST', $this->path, [
                'department_id' => 1,
                'name' => 'some name',
            ])
            ->assertStatus(403)
            ->assertJson(['data' => [
                'message' => 'Action not allowed for this department',
            ]]);
    }

    public function test_siteCreated(): void
    {
        $this->be($this->firstUser)
            ->json('POST', $this->path, [
                'department_id' => 1,
                'name' => 'some name',
                'description' => 'some description',
            ])
            ->assertStatus(201)
            ->assertJson(['data' => [
                'id' => 2,
                'name' => 'some name',
                'description' => 'some description',
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}
