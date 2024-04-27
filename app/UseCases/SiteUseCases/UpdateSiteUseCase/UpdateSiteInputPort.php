<?php

declare(strict_types=1);

namespace App\UseCases\SiteUseCases\UpdateSiteUseCase;

use App\Domain\Interfaces\ViewModel;

interface UpdateSiteInputPort
{
    /**
     * @param  UpdateSiteRequestModel  $request
     * @return ViewModel
     */
    public function updateSite(UpdateSiteRequestModel $request): ViewModel;
}
