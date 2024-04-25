<?php

namespace App\Domain\Interfaces\RackInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model only related methods for rack
 */
interface RackModel
{
    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo;

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo;

    /**
     * @return HasMany
     */
    public function devices(): HasMany;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with): ?Model;
}
