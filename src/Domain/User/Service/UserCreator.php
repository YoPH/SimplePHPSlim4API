<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserCreatorRepository;
use App\Exception\ValidationException;
use Valitron\Validator;

final class UserCreator
{
    private const MIN_LENGTH_USERNAME = 2
    private const MAX_LENGTH_USERNAME = 16;

    /**
     * @var UserCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserCreatorRepository $repository The repository
     */
    public function __construct(UserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function createUser(array $data): int
    {
        // Input validation
        $this->validateNewUser($data);

        // Insert user
        $userId = $this->repository->insertUser($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $userId;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @return void
     * @throws ValidationException
     *
     */
    private function validateNewUser(array $data): void
    {
        $validator = new Validator($data);
        $validator->rule('required', ['username', 'email']);
        $validator->rule('email', 'email');
        $validator->rule('lengthBetween', 'username', self::MIN_LENGTH_USERNAME, self::MAX_LENGTH_USERNAME);

        if (!$validator->validate()) {
            throw new ValidationException('Please check your input', implode(', ', $validator->errors()));
        }
    }
}
