<?php

declare(strict_types=1);

namespace App\Domain\User\Data;

final class UserReaderResult
{
    public int $id;

    public string $username;

    public string $firstName;

    public string $lastName;

    public string $email;
}
