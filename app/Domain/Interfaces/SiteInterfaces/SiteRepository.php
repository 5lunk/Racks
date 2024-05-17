<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\SiteInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface SiteRepository
{
    /**
     * @param  int  $id
     * @return SiteEntity&SiteBusinessRules
     */
    public function getById(int $id): SiteEntity&SiteBusinessRules;

    /**
     * @param  SiteEntity&SiteBusinessRules  $site
     * @return SiteEntity&SiteBusinessRules
     */
    public function create(SiteEntity&SiteBusinessRules $site): SiteEntity&SiteBusinessRules;

    /**
     * @param  SiteEntity&SiteBusinessRules  $site
     * @return SiteEntity&SiteBusinessRules
     */
    public function update(SiteEntity&SiteBusinessRules $site): SiteEntity&SiteBusinessRules;

    /**
     * @param  SiteEntity&SiteBusinessRules  $site
     * @return bool
     */
    public function delete(SiteEntity&SiteBusinessRules $site): bool;

    /**
     * @param  int|null  $id
     * @return array<array{
     *     region_name: string,
     *     department_name: string
     * }>
     */
    public function getLocation(?int $id): array;

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator;
}
