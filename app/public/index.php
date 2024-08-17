<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Infrastructure\Database\DatabaseConnection;
use App\Infrastructure\Database\RepositoryManager;
use App\Infrastructure\ErrorHandling\ErrorHandler;
use App\Presentation\LatestRepositoriesController;

$errorHandler = new ErrorHandler();
try {
    $db = DatabaseConnection::getConnection();
    $repositoryRepository = new RepositoryManager($db);
    $controller = new LatestRepositoriesController($repositoryRepository);

    echo $controller->index();

} catch (Exception $e) {
    $errorHandler->handle($e);
}