<?php

namespace App\Domain\Interfaces\SiteInterfaces;

use App\UseCases\SiteUseCases\CreateSiteUseCase\CreateSiteRequestModel;
use App\UseCases\SiteUseCases\UpdateSiteUseCase\UpdateSiteRequestModel;

interface SiteFactory
{
    /**
     * @param  CreateSiteRequestModel  $request
     * @return SiteEntity|SiteBusinessRules|SiteModel
     */
    public function makeFromCreateRequest(CreateSiteRequestModel $request): SiteEntity|SiteBusinessRules|SiteModel;

    /**
     * @param  UpdateSiteRequestModel  $request
     * @return SiteEntity|SiteBusinessRules|SiteModel
     */
    public function makeFromPatchRequest(UpdateSiteRequestModel $request): SiteEntity|SiteBusinessRules|SiteModel;
}
