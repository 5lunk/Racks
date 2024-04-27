<?php

declare(strict_types=1);

namespace App\UseCases\SiteUseCases\CreateSiteUseCase;

use App\Domain\Interfaces\ViewModel;

interface CreateSiteInputPort
{
    /**
     * @param  CreateSiteRequestModel  $request
     * @return ViewModel
     */
    public function createSite(CreateSiteRequestModel $request): ViewModel;
}
