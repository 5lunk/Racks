<?php

namespace Tests\Feature\Http\Controllers\BuildingControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteBuildingControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/building';

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

    public function test_noSuchBuilding(): void
    {
        $this->be($this->firstUser)
            ->json('DELETE', $this->path.'/3')
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such building',
            ]]);
    }

    public function test_permissionException(): void
    {
        $this->be($this->secondUser)
            ->json('DELETE', $this->path.'/1')
            ->assertStatus(403)
            ->assertJson(['data' => [
                'message' => 'Action not allowed for this department',
            ]]);
    }

    public function test_buildingDeleted(): void
    {
        $this->be($this->firstUser)
            ->json('DELETE', $this->path.'/1')
            ->assertStatus(204);
    }
}
