<?php

namespace Tests\Feature\Http\Controllers\RackControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateRackControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/rack';

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
            ->json('POST', $this->path, [
                'room_id' => 5,
                'amount' => 40,
                'name' => 'some name',
                'has_numbering_from_top_to_bottom' => false,
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'No such room',
            ]]);
    }

    public function test_permissionException(): void
    {
        $this->be($this->secondUser)
            ->json('POST', $this->path, [
                'room_id' => 1,
                'amount' => 40,
                'name' => 'some name',
                'has_numbering_from_top_to_bottom' => false,
            ])
            ->assertStatus(403)
            ->assertJson(['data' => [
                'message' => 'Action not allowed for this department',
            ]]);
    }

    public function test_rackNameException(): void
    {
        $this->be($this->firstUser)
            ->json('POST', $this->path, [
                'room_id' => 1,
                'amount' => 40,
                'name' => 'Test rack №1',
                'has_numbering_from_top_to_bottom' => false,
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'Rack with this name already exists in this room',
            ]]);
    }

    public function test_rackCreated(): void
    {
        $this->be($this->firstUser)
            ->json('POST', $this->path, [
                'room_id' => 1,
                'amount' => 40,
                'name' => 'some name',
                'has_numbering_from_top_to_bottom' => false,
            ])
            ->assertStatus(201)
            ->assertJson(['data' => [
                'id' => 3,
                'name' => 'some name',
                'amount' => 40,
                'has_numbering_from_top_to_bottom' => false,
                'vendor' => null,
                'model' => null,
                'description' => null,
                'responsible' => null,
                'financially_responsible_person' => null,
                'inventory_number' => null,
                'row' => null,
                'place' => null,
                'height' => null,
                'width' => null,
                'depth' => null,
                'unit_width' => null,
                'unit_depth' => null,
                'max_load' => null,
                'power_sockets' => null,
                'power_sockets_ups' => null,
                'has_cooler' => false,
                'room_id' => 1,
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}
