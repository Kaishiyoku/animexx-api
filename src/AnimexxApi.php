<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Kaishiyoku\AnimexxApi\Exception\RequestException;
use Kaishiyoku\AnimexxApi\Models\User;
use Kaishiyoku\AnimexxApi\Responses\UserResponse;

class AnimexxApi
{
    private const BASE_URL = 'https://rewind.animexx.de/api';

    /**
     * @var Client
     */
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param int $page
     * @return UserResponse
     * @throws GuzzleException
     */
    public function fetchUsers(int $page): UserResponse
    {
        $json = $this->fetchResource('get', '/users/?page=' . $page);

        return UserResponse::fromJson($json);
    }

    /**
     * @param int $id
     * @return User
     * @throws GuzzleException
     */
    public function fetchUser(int $id): User
    {
        $json = $this->fetchResource('get', '/users/' . $id);

        return User::fromJson($json['data']);
    }

    /**
     * @param string $method
     * @param string $path
     * @return array
     * @throws GuzzleException
     */
    private function fetchResource(string $method, string $path): array
    {
        $response = $this->httpClient->request($method, $this->getUrlFor($path));

        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $path
     * @return string
     */
    private function getUrlFor(string $path) : string
    {
        return self::BASE_URL . $path;
    }
}
