<?php

namespace Tests\Feature\Http\Controllers\RackControllers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class GetRackControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/rack';

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

    public function test_retrieveRack(): void
    {
        $this->json('GET', $this->path.'/1')
            ->assertStatus(200)
            ->assertJson(['data' => [
                'id' => 1,
                'name' => 'Test rack №1',
                'amount' => 42,
                'has_numbering_from_top_to_bottom' => false,
                'busy_units' => ['back' => [5, 6], 'front' => [35, 36, 38, 39, 41, 42]],
                'vendor' => 'ITK',
                'model' => 'ZPAS',
                'description' => 'Telecom rack',
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
                'updated_by' => 'tester',
                'room_id' => 1,
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }

    public function test_noSuchRack(): void
    {
        $this->json('GET', $this->path.'/6')
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such rack',
            ]]);
    }
}
