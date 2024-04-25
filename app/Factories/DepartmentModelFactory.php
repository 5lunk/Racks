<?php

namespace App\Factories;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentBusinessRules;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentEntity;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentFactory;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentModel;
use App\Models\Department;
use App\UseCases\DepartmentUseCases\CreateDepartmentUseCase\CreateDepartmentRequestModel;
use App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase\UpdateDepartmentRequestModel;

class DepartmentModelFactory implements DepartmentFactory
{
    /**
     * @param  CreateDepartmentRequestModel  $request
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function makeFromCreateRequest(CreateDepartmentRequestModel $request): DepartmentEntity|DepartmentBusinessRules|DepartmentModel
    {
        return new Department([
            'name' => $request->getName(),
            'region_id' => $request->getRegionId(),
        ]);
    }

    /**
     * @param  UpdateDepartmentRequestModel  $request
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function makeFromPatchRequest(UpdateDepartmentRequestModel $request): DepartmentEntity|DepartmentBusinessRules|DepartmentModel
    {
        return new Department([
            'id' => $request->getId(),
            'name' => $request->getName(),
        ]);
    }
}
