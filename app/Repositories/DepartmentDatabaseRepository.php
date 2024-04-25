<?php

namespace App\Repositories;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentBusinessRules;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentEntity;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentModel;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentRepository;
use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentDatabaseRepository implements DepartmentRepository
{
    /**
     * @param  int  $id
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function getById(int $id): DepartmentEntity|DepartmentBusinessRules|DepartmentModel
    {
        return Department::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return bool
     */
    public function exists(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): bool
    {
        return Department::where([
            'name' => $department->getName(),
            'region_id' => $department->getRegionId(),
        ])->exists();
    }

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function create(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): DepartmentEntity|DepartmentBusinessRules|DepartmentModel
    {
        return Department::create([
            'name' => $department->getName(),
            'region_id' => $department->getRegionId(),
        ]);
    }

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return int
     */
    public function delete(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): int
    {
        return Department::where('id', $department->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function update(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): DepartmentEntity|DepartmentBusinessRules|DepartmentModel
    {
        return tap(Department::where('id', $department->getId())
            ->first())
            ->update([
                'name' => $department->getName(),
            ]);
    }

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator
    {
        return Department::paginate($perPage);
    }
}
