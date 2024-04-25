<?php

namespace App\Domain\Interfaces\SiteInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model only related methods for site
 */
interface SiteModel
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo;

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
