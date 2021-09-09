<?php

namespace App\Domain\Users\Service;

use App\Domain\Users\Data\UserData;
use App\Domain\Users\Repository\UserRepository;
use App\Domain\Users\Service\UserValidator;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class UserUpdater
{
    private UserRepository $repository;

    private UserValidator $userValidator;


    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     * @param UserValidator $userValidator The validator
     */
    public function __construct(
        UserRepository $repository,
        UserValidator $userValidator
    ) {
        $this->repository = $repository;
        $this->userValidator = $userValidator;
    }

    /**
     * Update user.
     *
     * @param int $userId The user id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateUser(int $userId, array $data): array
    {
        // Input validation
        $this->userValidator->validateUserUpdate($userId, $data);

        // Validation was successfully
        $user = new UserData($data);
        $user->id = $userId;

        // Update the user
        return $this->repository->updateUser($user);

        // Logging
    }

    public function updateUserPassword(int $userId, array $data): array
    {
        // Input validation
        $this->userValidator->validateUserUpdate($userId, $data);

        // Validation was successfully
        $user = new UserData($data);
        $user->id = $userId;

        // Update the user
        return $this->repository->updateUserPassword($user);

        // Logging
    }
}