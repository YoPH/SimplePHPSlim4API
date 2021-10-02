<?php
declare(strict_types=1);

namespace App\Domain\User\Repository;

use PDO;

/**
 * Repository.
 */
final class UserCreatorRepository
{
    private const SQL_INSERT_USER = 'INSERT INTO users SET 
        username = :username, 
        first_name = :first_name, 
        last_name = :last_name, 
        email = :email';

    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function insertUser(array $user): int
    {
        $this->connection->prepare(self::SQL_INSERT_USER)->execute([
            'username' => $user['username'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
        ]);

        return (int)$this->connection->lastInsertId();
    }
}
