<?php

declare(strict_types=1);

namespace App\UseCases\RackUseCases\GetRackUseCase;

use App\Domain\Interfaces\RackInterfaces\RackRepository;
use App\Domain\Interfaces\ViewModel;

class GetRackInteractor implements GetRackInputPort
{
    /**
     * @param  GetRackOutputPort  $output
     * @param  RackRepository  $rackRepository
     */
    public function __construct(
        private readonly GetRackOutputPort $output,
        private readonly RackRepository $rackRepository
    ) {
    }

    /**
     * @param  GetRackRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getRack(GetRackRequestModel $request): ViewModel
    {
        // Try to get rack
        try {
            $rack = $this->rackRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchRack(
                resolve_proxy(GetRackResponseModel::class, ['rack' => null])
            );
        }

        return $this->output->retrieveRack(
            resolve_proxy(GetRackResponseModel::class, ['rack' => $rack])
        );
    }
}
