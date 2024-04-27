<?php

declare(strict_types=1);

namespace App\UseCases\DeviceUseCases\UpdateDeviceUseCase;

use App\Domain\Interfaces\ViewModel;

interface UpdateDeviceInputPort
{
    /**
     * @param  UpdateDeviceRequestModel  $request
     * @return ViewModel
     */
    public function updateDevice(UpdateDeviceRequestModel $request): ViewModel;
}
