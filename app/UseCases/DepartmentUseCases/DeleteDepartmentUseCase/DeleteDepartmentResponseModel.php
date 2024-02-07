<?php

namespace App\UseCases\DepartmentUseCases\DeleteDepartmentUseCase;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentEntity;

class DeleteDepartmentResponseModel
{
    public function __construct(
        private readonly ?DepartmentEntity $department
    ) {
    }

    public function getDepartment(): ?DepartmentEntity
    {
        return $this->department;
    }
}
