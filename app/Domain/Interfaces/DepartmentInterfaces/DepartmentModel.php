<?php

namespace App\Domain\Interfaces\DepartmentInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model only related methods for department
 */
interface DepartmentModel
{
    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo;

    /**
     * @return HasMany
     */
    public function children(): HasMany;

    /**
     * @return HasMany
     */
    public function users(): HasMany;

    /**
     * @return HasMany
     */
    public function buildings(): HasMany;

    /**
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with): ?Model;
}
