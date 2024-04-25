<?php

namespace App\Domain\Interfaces\DeviceInterfaces;

use App\UseCases\DeviceUseCases\CreateDeviceUseCase\CreateDeviceRequestModel;
use App\UseCases\DeviceUseCases\UpdateDeviceUseCase\UpdateDeviceRequestModel;

interface DeviceFactory
{
    /**
     * @param  CreateDeviceRequestModel  $request
     * @return DeviceEntity|DeviceBusinessRules|DeviceModel
     */
    public function makeFromPostRequest(CreateDeviceRequestModel $request): DeviceEntity|DeviceBusinessRules|DeviceModel;

    /**
     * @param  UpdateDeviceRequestModel  $request
     * @return DeviceEntity|DeviceBusinessRules|DeviceModel
     */
    public function makeFromPatchRequest(UpdateDeviceRequestModel $request): DeviceEntity|DeviceBusinessRules|DeviceModel;
}
