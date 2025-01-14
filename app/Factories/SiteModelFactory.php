<?php

declare(strict_types=1);

namespace App\Factories;

use App\Domain\Interfaces\SiteInterfaces\SiteBusinessRules;
use App\Domain\Interfaces\SiteInterfaces\SiteEntity;
use App\Domain\Interfaces\SiteInterfaces\SiteFactory;
use App\Models\Site;
use App\UseCases\SiteUseCases\CreateSiteUseCase\CreateSiteRequestModel;
use App\UseCases\SiteUseCases\UpdateSiteUseCase\UpdateSiteRequestModel;

class SiteModelFactory implements SiteFactory
{
    /**
     * @param  CreateSiteRequestModel  $request
     * @return SiteEntity&SiteBusinessRules
     */
    public function makeFromCreateRequest(CreateSiteRequestModel $request): SiteEntity&SiteBusinessRules
    {
        return new Site([
            'name' => $request->getName(),
            'description' => $request->getDescription(),
            'department_id' => $request->getDepartmentId(),
        ]);
    }

    /**
     * @param  UpdateSiteRequestModel  $request
     * @return SiteEntity&SiteBusinessRules
     */
    public function makeFromPatchRequest(UpdateSiteRequestModel $request): SiteEntity&SiteBusinessRules
    {
        return new Site([
            'id' => $request->getId(),
            'name' => $request->getName(),
            'description' => $request->getDescription(),
            'department_id' => $request->getDepartmentId(),
        ]);
    }
}
