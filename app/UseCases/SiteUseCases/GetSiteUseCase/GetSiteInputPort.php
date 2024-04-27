<?php

declare(strict_types=1);

namespace App\UseCases\SiteUseCases\GetSiteUseCase;

use App\Domain\Interfaces\ViewModel;

interface GetSiteInputPort
{
    /**
     * @param  GetSiteRequestModel  $request
     * @return ViewModel
     */
    public function getSite(GetSiteRequestModel $request): ViewModel;
}
