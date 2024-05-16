<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\DeviceControllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateDeviceControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $path = '/api/v1/auth/device'; // @phpstan-ignore-line

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

    public function test_noSuchDevice(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/29', [
                'description' => 'some description',
            ])
            ->assertStatus(404)
            ->assertJson(['data' => [
                'message' => 'No such device',
            ]]);
    }

    public function test_noSuchUnits(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/1', [
                'units' => [47],
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'No such units',
            ]]);
    }

    public function test_unitsAreBusy(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/1', [
                'units' => [39, 40],
            ])
            ->assertStatus(400)
            ->assertJson(['data' => [
                'message' => 'These units are busy',
            ]]);
    }

    public function test_deviceUpdated(): void
    {
        $this->be($this->firstUser)
            ->json('PATCH', $this->path.'/1', [
                'units' => [8],
            ])
            ->assertStatus(202)
            ->assertJson(['data' => [
                'id' => 1,
                'vendor' => null,
                'model' => null,
                'type' => 'RJ45 patch panel',
                'status' => 'Device active',
                'has_backside_location' => false,
                'units' => [8],
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
                'updated_by' => 'first_user',
                'created_at' => $this->now->utc()->format('Y-m-d H:i:s'),
                'updated_at' => $this->now->utc()->format('Y-m-d H:i:s'),
            ]]);
    }
}
