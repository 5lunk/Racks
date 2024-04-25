<?php

namespace App\Domain\Interfaces\RoomInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model only related methods for room
 */
interface RoomModel
{
    /**
     * @return BelongsTo
     */
    public function building(): BelongsTo;

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
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with): ?Model;
}
