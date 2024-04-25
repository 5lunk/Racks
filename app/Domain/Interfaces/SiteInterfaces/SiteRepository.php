<?php

namespace App\Domain\Interfaces\SiteInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface SiteRepository
{
    /**
     * @param  int  $id
     * @return SiteEntity|SiteBusinessRules|SiteModel
     */
    public function getById(int $id): SiteEntity|SiteBusinessRules|SiteModel;

    /**
     * @param  SiteEntity|SiteBusinessRules|SiteModel  $site
     * @return SiteEntity|SiteBusinessRules|SiteModel
     */
    public function create(SiteEntity|SiteBusinessRules|SiteModel $site): SiteEntity|SiteBusinessRules|SiteModel;

    /**
     * @param  SiteEntity|SiteBusinessRules|SiteModel  $site
     * @return SiteEntity|SiteBusinessRules|SiteModel
     */
    public function update(SiteEntity|SiteBusinessRules|SiteModel $site): SiteEntity|SiteBusinessRules|SiteModel;

    /**
     * @param  SiteEntity|SiteBusinessRules|SiteModel  $site
     * @return int
     */
    public function delete(SiteEntity|SiteBusinessRules|SiteModel $site): int;

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
