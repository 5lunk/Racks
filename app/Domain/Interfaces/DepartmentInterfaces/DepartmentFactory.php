<?php

namespace App\Domain\Interfaces\DepartmentInterfaces;

use App\UseCases\DepartmentUseCases\CreateDepartmentUseCase\CreateDepartmentRequestModel;
use App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase\UpdateDepartmentRequestModel;

interface DepartmentFactory
{
    /**
     * @param  CreateDepartmentRequestModel  $request
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function makeFromCreateRequest(CreateDepartmentRequestModel $request): DepartmentEntity|DepartmentBusinessRules|DepartmentModel;

    /**
     * @param  UpdateDepartmentRequestModel  $request
     * @return DepartmentEntity|DepartmentBusinessRules|DepartmentModel
     */
    public function makeFromPatchRequest(UpdateDepartmentRequestModel $request): DepartmentEntity|DepartmentBusinessRules|DepartmentModel;
}
