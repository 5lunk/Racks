<?php

declare(strict_types=1);

namespace App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentEntity;

class UpdateDepartmentResponseModel
{
    /**
     * @param  DepartmentEntity  $department
     */
    public function __construct(
        private readonly DepartmentEntity $department
    ) {
    }

    /**
     * @return DepartmentEntity
     */
    public function getDepartment(): DepartmentEntity
    {
        return $this->department;
    }
}
