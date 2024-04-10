<?php

namespace Tests\Feature\Http\Controllers\RoomControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateRoomControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/room';

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
            ->json('POST', $this->path, [
                'building_id' => 5,
                'building_floor' => '1st',
                'name' => 'some name',
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'No such building',
            ]]);
    }

    public function test_permissionException(): void
    {
        $this->be($this->secondUser)
            ->json('POST', $this->path, [
                'building_id' => 1,
                'building_floor' => '1st',
                'name' => 'some name',
            ])
            ->assertStatus(403)
            ->assertJson(['data' => [
                'message' => 'Action not allowed for this department',
            ]]);
    }

    public function test_roomNameException(): void
    {
        $this->be($this->firstUser)
            ->json('POST', $this->path, [
                'building_id' => 1,
                'building_floor' => '1st',
                'name' => 'Test room',
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'Room with this name already exists in this building',
            ]]);
    }

    public function test_roomCreated(): void
    {
        $this->be($this->firstUser)
            ->json('POST', $this->path, [
                'building_id' => 1,
                'building_floor' => '1st',
                'name' => 'some name',
            ])
            ->assertStatus(201)
            ->assertJson(['data' => [
                'id' => 3,
                'name' => 'some name',
                'building_floor' => '1st',
                'description' => null,
                'number_of_rack_spaces' => null,
                'area' => null,
                'responsible' => null,
                'cooling_system' => 'Centralized',
                'fire_suppression_system' => 'Centralized',
                'access_is_open' => false,
                'has_raised_floor' => false,
                'building_id' => 1,
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}
