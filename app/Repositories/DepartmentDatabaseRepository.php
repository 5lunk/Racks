<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentBusinessRules;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentEntity;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentRepository;
use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentDatabaseRepository implements DepartmentRepository
{
    /**
     * @param  int  $id
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function getById(int $id): DepartmentEntity&DepartmentBusinessRules
    {
        return Department::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return bool
     */
    public function exists(DepartmentEntity&DepartmentBusinessRules $department): bool
    {
        return Department::where([
            'name' => $department->getName(),
            'region_id' => $department->getRegionId(),
        ])->exists();
    }

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function create(DepartmentEntity&DepartmentBusinessRules $department): DepartmentEntity&DepartmentBusinessRules
    {
        return Department::create([
            'name' => $department->getName(),
            'region_id' => $department->getRegionId(),
        ]);
    }

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return bool
     */
    public function delete(DepartmentEntity&DepartmentBusinessRules $department): bool
    {
        return Department::where('id', $department->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function update(DepartmentEntity&DepartmentBusinessRules $department): DepartmentEntity&DepartmentBusinessRules
    {
        return tap(Department::where('id', $department->getId())
            ->first())
            ->update([
                'name' => $department->getName(),
            ]);
    }

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator
    {
        return Department::paginate($perPage);
    }
}
