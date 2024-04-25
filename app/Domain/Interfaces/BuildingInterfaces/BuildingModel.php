<?php

namespace App\Domain\Interfaces\BuildingInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model only related methods for building
 */
interface BuildingModel
{
    /**
     * @return BelongsTo
     */
    public function site(): BelongsTo;

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo;

    /**
     * @return HasMany
     */
    public function children(): HasMany;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @param  array<mixed>|string  $with  Reload param
     * @return Model|null ?Model
     */
    public function fresh($with): ?Model;
}
