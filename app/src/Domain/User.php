<?php
namespace App\Domain;
/**
 *  User представляет сущность пользователя GitHub.
 */
class User
{
    private int $id;
    private string $githubUsername;

    public function __construct(int $id, string $githubUsername)
    {
        $this->id = $id;
        $this->githubUsername = $githubUsername;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGithubUsername(): string
    {
        return $this->githubUsername;
    }
}