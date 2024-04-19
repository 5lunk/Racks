<?php

namespace Tests\Feature\Http\Controllers\RackControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateRackControllerTest extends TestCase
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

    public function test_noSuchRack(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/6', [
                'name' => 'some name',
            ])
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such rack',
            ]]);
    }

    public function test_permissionException(): void
    {
        $this->be($this->secondUser)
            ->json('PATCH', $this->path.'/1', [
                'name' => 'some name',
                'has_numbering_from_top_to_bottom' => true,
            ])
            ->assertStatus(403)
            ->assertJson(['data' => [
                'message' => 'Action not allowed for this department',
            ]]);
    }

    public function test_rackUpdated(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/1', [
                'description' => 'some description',
            ])
            ->assertStatus(202)
            ->assertJson(['data' => [
                'name' => 'Test rack №1',
                'amount' => 42,
                'has_numbering_from_top_to_bottom' => false,
                'busy_units' => ['back' => [5, 6], 'front' => [35, 36, 38, 39, 41, 42]],
                'vendor' => 'ITK',
                'model' => 'ZPAS',
                'description' => 'some description',
                'responsible' => 'David Wm. Sims',
                'financially_responsible_person' => 'David Wm. Sims',
                'inventory_number' => '12341234787',
                'row' => '1',
                'place' => '3',
                'height' => 2000,
                'width' => 600,
                'depth' => 1360,
                'unit_width' => 19,
                'unit_depth' => 580,
                'max_load' => 1360,
                'power_sockets' => 3,
                'power_sockets_ups' => 2,
                'has_cooler' => true,
                'updated_by' => 'first_user',
                'room_id' => 1,
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}