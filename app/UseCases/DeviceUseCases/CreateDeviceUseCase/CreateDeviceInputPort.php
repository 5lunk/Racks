<?php

declare(strict_types=1);

namespace App\UseCases\DeviceUseCases\CreateDeviceUseCase;

use App\Domain\Interfaces\ViewModel;

interface CreateDeviceInputPort
{
    /**
     * @param  CreateDeviceRequestModel  $request
     * @return ViewModel
     */
    public function createDevice(CreateDeviceRequestModel $request): ViewModel;
}
