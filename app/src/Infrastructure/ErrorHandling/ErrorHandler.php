<?php
namespace App\Infrastructure\ErrorHandling;

use Exception;
use App\Infrastructure\GitHub\Exception\GitHubApiException;
use PDOException;

class ErrorHandler
{
    public function handle(Exception $e): void
    {
        if ($e instanceof PDOException) {
            error_log("Database error: " . $e->getMessage());
        } elseif ($e instanceof GitHubApiException) {
            error_log("GitHub API error: " . $e->getMessage());
        } else {
            error_log("An error occurred: " . $e->getMessage());
        }
    }
}