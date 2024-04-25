<?php

namespace App\Domain\Interfaces\DepartmentInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface DepartmentRepository
{
    /**
     * @param  int  $id
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function getById(int $id): DepartmentEntity|DepartmentBusinessRules|DepartmentModel;

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return bool
     */
    public function exists(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): bool;

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function create(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): DepartmentEntity|DepartmentBusinessRules|DepartmentModel;

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return int
     */
    public function delete(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): int;

    /**
     * @param  DepartmentEntity|DepartmentBusinessRules|DepartmentModel  $department
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function update(DepartmentEntity|DepartmentBusinessRules|DepartmentModel $department): DepartmentEntity|DepartmentBusinessRules|DepartmentModel;

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator;
}
