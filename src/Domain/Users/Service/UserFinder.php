<?php

namespace App\Domain\Users\Service;

use App\Domain\Users\Data\UserData;
use App\Domain\Users\Repository\UserFinderRepository;

/**
 * Service.
 */
final class UserFinder
{
    private UserFinderRepository $repository;

    /**
     * The constructor.
     *
     * @param UserFinderRepository $repository The repository
     */
    public function __construct(UserFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find users.
     *
     * @return UserData[] A list of users
     */
    public function findUsers(): array
    {
        // Input validation
        // ...

        return $this->repository->findUsers();
    }
}
