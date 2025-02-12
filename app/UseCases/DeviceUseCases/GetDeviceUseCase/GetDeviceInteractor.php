<?php

declare(strict_types=1);

namespace App\UseCases\DeviceUseCases\GetDeviceUseCase;

use App\Domain\Interfaces\DeviceInterfaces\DeviceRepository;
use App\Domain\Interfaces\ViewModel;

class GetDeviceInteractor implements GetDeviceInputPort
{
    /**
     * @param  GetDeviceOutputPort  $output
     * @param  DeviceRepository  $deviceRepository
     */
    public function __construct(
        private readonly GetDeviceOutputPort $output,
        private readonly DeviceRepository $deviceRepository
    ) {
    }

    /**
     * @param  GetDeviceRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getDevice(GetDeviceRequestModel $request): ViewModel
    {
        // Try to get device
        try {
            $device = $this->deviceRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchDevice(
                resolve_proxy(GetDeviceResponseModel::class, ['device' => null])
            );
        }

        return $this->output->retrieveDevice(
            resolve_proxy(GetDeviceResponseModel::class, ['device' => $device])
        );
    }
}
