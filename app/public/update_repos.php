<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Infrastructure\Database\DatabaseConnection;
use App\Infrastructure\Database\UserRepository;
use App\Infrastructure\Database\RepositoryManager;
use App\Infrastructure\ErrorHandling\ErrorHandler;
use App\Infrastructure\GitHub\GitHubApiClient;
use App\Application\UpdateRepositoriesService;

$errorHandler = new ErrorHandler();

try {
    $db = DatabaseConnection::getConnection();
    $userRepository = new UserRepository($db);
    $repositoryRepository = new RepositoryManager($db);
    $gitHubApiClient = new GitHubApiClient(GITHUB_TOKEN);

    $service = new UpdateRepositoriesService($userRepository, $repositoryRepository, $gitHubApiClient);
    $service->execute();

} catch (Exception $e) {
    $errorHandler->handle($e);
}