<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\RoomControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateRoomControllerTest extends TestCase
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

    public function test_noSuchRoom(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/3', [
                'name' => 'some name',
            ])
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such room',
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

    public function test_roomNameException(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/2', [
                'name' => 'Test room',
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'Room with this name already exists in this building',
            ]]);
    }

    public function test_roomUpdated(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/1', [
                'description' => 'some description',
            ])
            ->assertStatus(202)
            ->assertJson(['data' => [
                'id' => 1,
                'name' => 'Test room',
                'building_floor' => '2nd',
                'description' => 'some description',
                'number_of_rack_spaces' => 6,
                'area' => 12,
                'responsible' => 'Smith W.',
                'cooling_system' => 'Centralized',
                'fire_suppression_system' => 'Centralized',
                'access_is_open' => false,
                'has_raised_floor' => false,
                'building_id' => 1,
                'department_id' => 1,
                'updated_by' => 'first_user',
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}
