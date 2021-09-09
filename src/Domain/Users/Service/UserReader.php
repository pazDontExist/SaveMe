<?php

namespace App\Domain\Users\Service;

use App\Domain\Users\Data\UserData;
use App\Domain\Users\Repository\UserRepository;

/**
 * Service.
 */
final class UserReader
{
    private UserRepository $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user.
     *
     * @param int $userId The user id
     *
     * @return UserData The user data
     */
    public function getUserData(int $userId): UserData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $user = $this->repository->getUserById($userId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $user;
    }
}