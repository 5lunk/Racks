<?php

declare(strict_types=1);

namespace App\Factories;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentBusinessRules;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentEntity;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentFactory;
use App\Models\Department;
use App\UseCases\DepartmentUseCases\CreateDepartmentUseCase\CreateDepartmentRequestModel;
use App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase\UpdateDepartmentRequestModel;

class DepartmentModelFactory implements DepartmentFactory
{
    /**
     * @param  CreateDepartmentRequestModel  $request
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function makeFromCreateRequest(CreateDepartmentRequestModel $request): DepartmentEntity&DepartmentBusinessRules
    {
        return new Department([
            'name' => $request->getName(),
            'region_id' => $request->getRegionId(),
        ]);
    }

    /**
     * @param  UpdateDepartmentRequestModel  $request
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function makeFromPatchRequest(UpdateDepartmentRequestModel $request): DepartmentEntity&DepartmentBusinessRules
    {
        return new Department([
            'id' => $request->getId(),
            'name' => $request->getName(),
        ]);
    }
}
