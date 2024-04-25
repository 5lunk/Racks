<?php

namespace App\Domain\Interfaces\RegionInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model only related methods for region
 */
interface RegionModel
{
    /**
     * @return HasMany
     */
    public function children(): HasMany;

    /**
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with): ?Model;
}
