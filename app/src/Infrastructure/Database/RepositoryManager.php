<?php
namespace App\Infrastructure\Database;

use App\Domain\Repository;
use PDO;
use PDOException;

/**
 * RepositoryManager отвечает за взаимодействие с базой данных для сущности Repository.
 */
class RepositoryManager
{
    private PDO $db;

    /**
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Сохраняет или обновляет репозиторий в базе данных.
     *
     * @param Repository $repository Объект репозитория для сохранения.
     * @throws PDOException
     */
    public function save(Repository $repository): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO repositories (user_id, name, updated_at) 
            VALUES (:user_id, :name, :updated_at)
            ON CONFLICT (user_id, name) DO UPDATE SET updated_at = :updated_at
        ");
        $stmt->execute([
            ':user_id' => $repository->getUserId(),
            ':name' => $repository->getName(),
            ':updated_at' => $repository->getUpdatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Находит последние репозитории по дате обновления.
     *
     * @param int $limit Количество репозиториев для выборки.
     * @return array Массив последних репозиториев.
     * @throws PDOException
     */
    public function findLatest(int $limit): array
    {
        $stmt = $this->db->prepare("
            SELECT u.github_username, r.name, r.updated_at 
            FROM repositories r
            JOIN users u ON r.user_id = u.id
            ORDER BY r.updated_at DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}