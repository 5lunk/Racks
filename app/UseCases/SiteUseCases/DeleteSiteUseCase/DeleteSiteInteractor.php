<?php

declare(strict_types=1);

namespace App\UseCases\SiteUseCases\DeleteSiteUseCase;

use App\Domain\Interfaces\SiteInterfaces\SiteRepository;
use App\Domain\Interfaces\ViewModel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DeleteSiteInteractor implements DeleteSiteInputPort
{
    /**
     * @param  DeleteSiteOutputPort  $output
     * @param  SiteRepository  $siteRepository
     */
    public function __construct(
        private readonly DeleteSiteOutputPort $output,
        private readonly SiteRepository $siteRepository
    ) {
    }

    /**
     * @param  DeleteSiteRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deleteSite(DeleteSiteRequestModel $request): ViewModel
    {
        // Try to get site
        try {
            $site = $this->siteRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchSite(
                resolve_proxy(DeleteSiteResponseModel::class, ['site' => null])
            );
        }

        // User department check
        if (! Gate::allows('departmentCheck', $site->getDepartmentId())) {
            return $this->output->permissionException(
                resolve_proxy(DeleteSiteResponseModel::class, ['site' => $site])
            );
        }

        // Try to delete
        try {
            $this->siteRepository->delete($site);
        } catch (\Exception $e) {
            return $this->output->unableToDeleteSite(
                resolve_proxy(DeleteSiteResponseModel::class, ['site' => $site]),
                $e
            );
        }

        Log::channel('action_log')->info("Delete Site --> pk {$site->getId()}", [
            'deleted_data' => $site->toArray(),
            'by_user' => $request->getUserName(),
        ]);

        return $this->output->siteDeleted(
            resolve_proxy(DeleteSiteResponseModel::class, ['site' => $site])
        );
    }
}
