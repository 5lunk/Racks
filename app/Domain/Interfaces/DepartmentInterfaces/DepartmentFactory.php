<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\DepartmentInterfaces;

use App\UseCases\DepartmentUseCases\CreateDepartmentUseCase\CreateDepartmentRequestModel;
use App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase\UpdateDepartmentRequestModel;

interface DepartmentFactory
{
    /**
     * @param  CreateDepartmentRequestModel  $request
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function makeFromCreateRequest(CreateDepartmentRequestModel $request): DepartmentEntity&DepartmentBusinessRules;

    /**
     * @param  UpdateDepartmentRequestModel  $request
     * @return DepartmentEntity&DepartmentBusinessRules
     */
    public function makeFromPatchRequest(UpdateDepartmentRequestModel $request): DepartmentEntity&DepartmentBusinessRules;
}
