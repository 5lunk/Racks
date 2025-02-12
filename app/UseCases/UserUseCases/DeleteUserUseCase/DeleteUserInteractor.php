<?php

declare(strict_types=1);

namespace App\UseCases\UserUseCases\DeleteUserUseCase;

use App\Domain\Interfaces\UserInterfaces\UserRepository;
use App\Domain\Interfaces\ViewModel;

class DeleteUserInteractor implements DeleteUserInputPort
{
    /**
     * @param  DeleteUserOutputPort  $output
     * @param  UserRepository  $userRepository
     */
    public function __construct(
        private DeleteUserOutputPort $output,
        private UserRepository $userRepository
    ) {
    }

    /**
     * @param  DeleteUserRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deleteUser(DeleteUserRequestModel $request): ViewModel
    {
        // Try to get user
        try {
            $user = $this->userRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchUser(
                resolve_proxy(DeleteUserResponseModel::class, ['user' => null])
            );
        }

        // Try to delete
        try {
            $this->userRepository->delete($user);
        } catch (\Exception $e) {
            return $this->output->unableToDeleteUser(
                resolve_proxy(DeleteUserResponseModel::class, ['user' => $user]),
                $e
            );
        }

        return $this->output->userDeleted(
            resolve_proxy(DeleteUserResponseModel::class, ['user' => $user])
        );
    }
}
