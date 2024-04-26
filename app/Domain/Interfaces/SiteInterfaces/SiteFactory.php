<?php

namespace App\Domain\Interfaces\SiteInterfaces;

use App\UseCases\SiteUseCases\CreateSiteUseCase\CreateSiteRequestModel;
use App\UseCases\SiteUseCases\UpdateSiteUseCase\UpdateSiteRequestModel;

interface SiteFactory
{
    /**
     * @param  CreateSiteRequestModel  $request
     * @return SiteEntity|SiteBusinessRules
     */
    public function makeFromCreateRequest(CreateSiteRequestModel $request): SiteEntity|SiteBusinessRules;

    /**
     * @param  UpdateSiteRequestModel  $request
     * @return SiteEntity|SiteBusinessRules
     */
    public function makeFromPatchRequest(UpdateSiteRequestModel $request): SiteEntity|SiteBusinessRules;
}
