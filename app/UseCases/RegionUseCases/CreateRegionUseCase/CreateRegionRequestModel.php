<?php

declare(strict_types=1);

namespace App\UseCases\RegionUseCases\CreateRegionUseCase;

class CreateRegionRequestModel
{
    /**
     * @param  array<mixed>  $attributes
     */
    public function __construct(
        private readonly array $attributes
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->attributes['name'];
    }
}
