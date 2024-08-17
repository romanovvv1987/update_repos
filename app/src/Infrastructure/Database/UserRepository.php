<?php
namespace App\Infrastructure\Database;

use App\Domain\User;
use PDO;
use PDOException;

/**
 * UserRepository отвечает за операции, связанные с сущностью User.
 */
class UserRepository
{
    private PDO $db;

    /**
     * @param PDO $db Соединение с базой данных.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Находит всех пользователей в базе данных.
     *
     * @return array Массив объектов User.
     * @throws PDOException
     */
    public function findAll(): array
    {
        try {
            $stmt = $this->db->query("SELECT id, github_username FROM users");
            return array_map(
                fn($row) => new User($row['id'], $row['github_username']),
                $stmt->fetchAll(PDO::FETCH_ASSOC)
            );
        } catch (PDOException $e) {
            throw new PDOException("Failed to find all users: " . $e->getMessage());
        }
    }
}