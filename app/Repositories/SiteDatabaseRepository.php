<?php

namespace App\Repositories;

use App\Domain\Interfaces\SiteInterfaces\SiteBusinessRules;
use App\Domain\Interfaces\SiteInterfaces\SiteEntity;
use App\Domain\Interfaces\SiteInterfaces\SiteRepository;
use App\Models\Site;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SiteDatabaseRepository implements SiteRepository
{
    /**
     * @param  int  $id
     * @return SiteEntity|SiteBusinessRules
     */
    public function getById(int $id): SiteEntity|SiteBusinessRules
    {
        return Site::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  SiteEntity|SiteBusinessRules  $site
     * @return SiteEntity|SiteBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function create(SiteEntity|SiteBusinessRules $site): SiteEntity|SiteBusinessRules
    {
        return Site::create($site->getAttributeSet()->toArray());
    }

    /**
     * @param  SiteEntity|SiteBusinessRules  $site
     * @return SiteEntity|SiteBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function update(SiteEntity|SiteBusinessRules $site): SiteEntity|SiteBusinessRules
    {
        return tap(Site::where('id', $site->getId())
            ->first())
            ->update(
                $site->getAttributeSet()->toArray()
            );
    }

    /**
     * @param  SiteEntity|SiteBusinessRules  $site
     * @return int
     */
    public function delete(SiteEntity|SiteBusinessRules $site): int
    {
        return Site::where('id', $site->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  string|null  $id
     * @return array<array{
     *     region_name: string,
     *     department_name: string
     * }>
     */
    public function getLocation(?string $id): array
    {
        return DB::table('sites')
            ->where('sites.id', $id)
            ->select(
                'regions.name as region_name',
                'departments.name as department_name',
            )
            ->join('departments', 'sites.department_id', '=', 'departments.id')
            ->join('regions', 'departments.region_id', '=', 'regions.id')
            ->get()
            ->toArray();
    }

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator
    {
        return Site::paginate($perPage);
    }
}
