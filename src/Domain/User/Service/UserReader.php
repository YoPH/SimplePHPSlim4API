<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserReaderResult;
use App\Domain\User\Repository\UserReaderRepository;
use App\Exception\ValidationException;

final class UserReader
{
    private UserReaderRepository $repository;

    public function __construct(UserReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user by the given user id.
     *
     * @param int|null $userId The user id
     *
     * @return UserReaderResult The user data
     *
     * @throws ValidationException
     */
    public function getUserDetails(?int $userId): UserReaderResult
    {
        if (empty($userId)) {
            throw new ValidationException('User ID required');
        }

        $userRow = $this->repository->getUserById($userId);

        $user = new UserReaderResult();
        $user->id = (int)$userRow['id'];
        $user->username = (string)$userRow['username'];
        $user->firstName = (string)$userRow['first_name'];
        $user->lastName = (string)$userRow['last_name'];
        $user->email = (string)$userRow['email'];

        return $user;
    }
}
