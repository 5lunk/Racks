<?php

declare(strict_types=1);

namespace App\UseCases\RegionUseCases\DeleteRegionUseCase;

use App\Domain\Interfaces\RegionInterfaces\RegionRepository;
use App\Domain\Interfaces\ViewModel;

class DeleteRegionInteractor implements DeleteRegionInputPort
{
    /**
     * @param  DeleteRegionOutputPort  $output
     * @param  RegionRepository  $regionRepository
     */
    public function __construct(
        private readonly DeleteRegionOutputPort $output,
        private readonly RegionRepository $regionRepository
    ) {
    }

    /**
     * @param  DeleteRegionRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deleteRegion(DeleteRegionRequestModel $request): ViewModel
    {
        // Try to get region
        try {
            $region = $this->regionRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchRegion(
                resolve_proxy(DeleteRegionResponseModel::class, ['region' => null])
            );
        }

        // Try to delete
        try {
            $this->regionRepository->delete($region);
        } catch (\Exception $e) {
            return $this->output->unableToDeleteRegion(
                resolve_proxy(DeleteRegionResponseModel::class, ['region' => $region]),
                $e
            );
        }

        return $this->output->regionDeleted(
            resolve_proxy(DeleteRegionResponseModel::class, ['region' => $region])
        );
    }
}
