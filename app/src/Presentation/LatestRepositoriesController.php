<?php
namespace App\Presentation;

use App\Infrastructure\Database\RepositoryManager;

/**
 * LatestRepositoriesController отвечает за отображение данных
 */
class LatestRepositoriesController
{
    private const LATEST_REPOS_COUNT = 10;

    private RepositoryManager $repositoryManager;

    /**
     * @param RepositoryManager $repositoryManager
     */
    public function __construct(RepositoryManager $repositoryManager)
    {
        $this->repositoryManager = $repositoryManager;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function index(): string
    {
        $repos = $this->repositoryManager->findLatest(self::LATEST_REPOS_COUNT);
        return $this->renderView('latest_repositories.php', ['repos' => $repos]);
    }

    /**
     * @param string $viewName
     * @param array $data
     * @return string
     */
    private function renderView(string $viewName, array $data): string
    {
        ob_start();
        extract($data);
        include __DIR__ . "/../../views/$viewName";
        return ob_get_clean();
    }
}