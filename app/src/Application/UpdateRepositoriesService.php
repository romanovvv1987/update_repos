<?php
namespace App\Application;

use App\Domain\Repository;
use App\Infrastructure\Database\UserRepository;
use App\Infrastructure\Database\RepositoryManager;
use App\Infrastructure\GitHub\Exception\GitHubApiException;
use App\Infrastructure\GitHub\GitHubApiClient;
use Exception;

/**
 * UpdateRepositoriesService отвечает за обновление информации о репозиториях.
 */
class UpdateRepositoriesService
{
    private UserRepository $userRepository;
    private RepositoryManager $repositoryRepository;
    private GitHubApiClient $gitHubApiClient;

    /**
     * @param UserRepository $userRepository
     * @param RepositoryManager $repositoryRepository
     * @param GitHubApiClient $gitHubApiClient
     */
    public function __construct(
        UserRepository $userRepository,
        RepositoryManager $repositoryRepository,
        GitHubApiClient $gitHubApiClient
    ) {
        $this->userRepository = $userRepository;
        $this->repositoryRepository = $repositoryRepository;
        $this->gitHubApiClient = $gitHubApiClient;
    }

    /**
     * Выполняет обновление информации о репозиториях.
     *
     * @throws Exception
     */
    public function execute(): void
    {
        try {
            $users = $this->userRepository->findAll();

            foreach ($users as $user) {
                $repos = $this->gitHubApiClient->getUserRepositories($user->getGithubUsername());

                foreach ($repos as $repo) {
                    $repository = new Repository(
                        0,
                        $user->getId(),
                        $repo['name'],
                        new \DateTime($repo['updated_at'])
                    );
                    $this->repositoryRepository->save($repository);
                }
            }
        } catch (Exception $e) {
            throw new GitHubApiException("Failed to update repositories: " . $e->getMessage());
        }
    }
}