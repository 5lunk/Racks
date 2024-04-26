<?php

namespace App\Domain\Interfaces\SiteInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface SiteRepository
{
    /**
     * @param  int  $id
     * @return SiteEntity|SiteBusinessRules
     */
    public function getById(int $id): SiteEntity|SiteBusinessRules;

    /**
     * @param  SiteEntity|SiteBusinessRules  $site
     * @return SiteEntity|SiteBusinessRules
     */
    public function create(SiteEntity|SiteBusinessRules $site): SiteEntity|SiteBusinessRules;

    /**
     * @param  SiteEntity|SiteBusinessRules  $site
     * @return SiteEntity|SiteBusinessRules
     */
    public function update(SiteEntity|SiteBusinessRules $site): SiteEntity|SiteBusinessRules;

    /**
     * @param  SiteEntity|SiteBusinessRules  $site
     * @return int
     */
    public function delete(SiteEntity|SiteBusinessRules $site): int;

    /**
     * @param  string|null  $id
     * @return array<array{
     *     region_name: string,
     *     department_name: string
     * }>
     */
    public function getLocation(?string $id): array;

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator;
}
