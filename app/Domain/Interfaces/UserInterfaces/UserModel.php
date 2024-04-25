<?php

namespace App\Domain\Interfaces\UserInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model only related methods for user
 */
interface UserModel
{
    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo;

    /**
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with): ?Model;
}
