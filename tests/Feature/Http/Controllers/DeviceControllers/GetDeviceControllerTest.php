<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\DeviceControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class GetDeviceControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/device';

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

    public function test_retrieveRoom(): void
    {
        $this->json('GET', $this->path.'/1')
            ->assertStatus(200)
            ->assertJson(['data' => [
                'id' => 1,
                'units' => [41],
                'type' => 'RJ45 patch panel',
                'updated_by' => 'tester',
                'vendor' => null,
                'model' => null,
                'status' => 'Device active',
                'has_backside_location' => false,
                'hostname' => null,
                'ip' => null,
                'stack' => null,
                'ports_amount' => null,
                'software_version' => null,
                'power_type' => 'IEC C14 socket',
                'power_w' => null,
                'power_v' => null,
                'power_ac_dc' => 'AC',
                'serial_number' => null,
                'description' => null,
                'project' => null,
                'ownership' => 'Our department',
                'responsible' => null,
                'financially_responsible_person' => null,
                'inventory_number' => null,
                'fixed_asset' => null,
                'link_to_docs' => null,
                'rack_id' => 1,
                'department_id' => 1,
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }

    public function test_noSuchDevice(): void
    {
        $this->json('GET', $this->path.'/25')
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such device',
            ]]);
    }
}
