<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\DepartmentInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface DepartmentRepository
{
    /**
     * @param  int  $id
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function getById(int $id): DepartmentEntity&DepartmentBusinessRules;

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return bool
     */
    public function exists(DepartmentEntity&DepartmentBusinessRules $department): bool;

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function create(DepartmentEntity&DepartmentBusinessRules $department): DepartmentEntity&DepartmentBusinessRules;

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return bool
     */
    public function delete(DepartmentEntity&DepartmentBusinessRules $department): bool;

    /**
     * @param  DepartmentEntity&DepartmentBusinessRules  $department
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function update(DepartmentEntity&DepartmentBusinessRules $department): DepartmentEntity&DepartmentBusinessRules;

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator;
}
