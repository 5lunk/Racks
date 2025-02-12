<?php

declare(strict_types=1);

namespace App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase;

use App\Domain\Interfaces\ViewModel;

interface UpdateDepartmentInputPort
{
    /**
     * @param  UpdateDepartmentRequestModel  $request
     * @return ViewModel
     */
    public function updateDepartment(UpdateDepartmentRequestModel $request): ViewModel;
}
