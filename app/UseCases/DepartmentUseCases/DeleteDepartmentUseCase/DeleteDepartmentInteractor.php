<?php

declare(strict_types=1);

namespace App\UseCases\DepartmentUseCases\DeleteDepartmentUseCase;

use App\Domain\Interfaces\DepartmentInterfaces\DepartmentRepository;
use App\Domain\Interfaces\ViewModel;
use App\UseCases\DepartmentUseCases\UpdateDepartmentUseCase\UpdateDepartmentResponseModel;

class DeleteDepartmentInteractor implements DeleteDepartmentInputPort
{
    /**
     * @param  DeleteDepartmentOutputPort  $output
     * @param  DepartmentRepository  $departmentRepository
     */
    public function __construct(
        private readonly DeleteDepartmentOutputPort $output,
        private readonly DepartmentRepository $departmentRepository
    ) {
    }

    /**
     * @param  DeleteDepartmentRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deleteDepartment(DeleteDepartmentRequestModel $request): ViewModel
    {
        // Try to get department
        try {
            $department = $this->departmentRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchDepartment(
                resolve_proxy(DeleteDepartmentResponseModel::class, ['department' => null])
            );
        }

        // Try to delete
        try {
            $this->departmentRepository->delete($department);
        } catch (\Exception $e) {
            return $this->output->unableToDeleteDepartment(
                resolve_proxy(UpdateDepartmentResponseModel::class, ['department' => $department]),
                $e
            );
        }

        return $this->output->departmentDeleted(
            resolve_proxy(DeleteDepartmentResponseModel::class, ['department' => $department])
        );
    }
}
