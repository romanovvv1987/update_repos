<?php
namespace App\Domain;
/**
 *  Repository представляет сущность репозитория GitHub.
 */
class Repository
{
    private int $id;
    private int $userId;
    private string $name;
    private \DateTime $updatedAt;

    public function __construct(int $id, int $userId, string $name, \DateTime $updatedAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}