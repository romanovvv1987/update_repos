<?php
namespace App\Infrastructure\GitHub\Exception;

use Exception;

/**
 * Исключение для обработки взаимсдействия с гитхабом
 */
class GitHubApiException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}