<?php
namespace App\Infrastructure\GitHub;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Infrastructure\GitHub\Exception\GitHubApiException;

/**
 *  GitHubApiClient отвечает за взаимодействие с  GitHub
 */
class GitHubApiClient
{
    private Client $client;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
            'headers' => [
                'User-Agent' => 'PHP Script',
                'Authorization' => "token $token"
            ]
        ]);
    }

    /**
     * Получает репозитории пользователя от API GitHub.
     *
     * @param string $username Имя пользователя GitHub.
     * @return array Массив репозиториев пользователя.
     * @throws GitHubApiException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getUserRepositories(string $username): array
    {
        try {
            $response = $this->client->request('GET', "users/$username/repos");
            $body = $response->getBody();
            $data = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new GitHubApiException("Failed to decode JSON response: " . json_last_error_msg());
            }

            return $data;
        } catch (RequestException $e) {
            throw new GitHubApiException("GitHub API request failed: " . $e->getMessage());
        }
    }
}