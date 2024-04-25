<?php

namespace App\Domain\Interfaces\DeviceInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model only related methods for device
 */
interface DeviceModel
{
    /**
     * @param  array<mixed>|string  $with  Reload param
     * @return Model|null ?Model
     */
    public function fresh($with): ?Model;

    /**
     * Belongs to rack
     *
     * @return BelongsTo
     */
    public function rack(): BelongsTo;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;
}
