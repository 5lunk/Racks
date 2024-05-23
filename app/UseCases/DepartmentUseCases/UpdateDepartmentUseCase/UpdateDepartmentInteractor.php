<?php

declare(strict_types=1);

namespace App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentFactory;
use App\Domain\Interfaces\DepartmentInterfaces\DepartmentRepository;
use App\Domain\Interfaces\ViewModel;

class UpdateDepartmentInteractor implements UpdateDepartmentInputPort
{
    /**
     * @param  UpdateDepartmentOutputPort  $output
     * @param  DepartmentRepository  $departmentRepository
     * @param  DepartmentFactory  $departmentFactory
     */
    public function __construct(
        private readonly UpdateDepartmentOutputPort $output,
        private readonly DepartmentRepository $departmentRepository,
        private readonly DepartmentFactory $departmentFactory,
    ) {
    }

    /**
     * @param  UpdateDepartmentRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updateDepartment(UpdateDepartmentRequestModel $request): ViewModel
    {
        $departmentUpdating = $this->departmentFactory->makeFromPatchRequest($request);

        // Try to get department
        try {
            $department = $this->departmentRepository->getById($departmentUpdating->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchDepartment(
                resolve_proxy(UpdateDepartmentResponseModel::class, ['department' => $departmentUpdating])
            );
        }

        // Try to update
        try {
            $department = $this->departmentRepository->update($departmentUpdating);
        } catch (\Exception $e) {
            return $this->output->unableToUpdateDepartment(
                resolve_proxy(UpdateDepartmentResponseModel::class, ['department' => $departmentUpdating]),
                $e
            );
        }

        return $this->output->departmentUpdated(
            resolve_proxy(UpdateDepartmentResponseModel::class, ['department' => $department])
        );
    }
}
