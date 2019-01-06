<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Client;
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
     */
    public function fetchUsers(int $page): UserResponse
    {
        $json = $this->fetchResource('get', '/users/?page=' . $page);

        return UserResponse::fromJson($json);
    }

    /**
     * @return UserResponse
     */
    public function fetchAllUsers(): UserResponse
    {
        $userResponse = $this->fetchUsers(1);

        for ($page = 2; $page <= $userResponse->getMeta()->getLastPage(); $page++) {
            $users = $userResponse->getUsers();

            $currentUserResponse = $this->fetchUsers($page);

            $currentUserResponse->getUsers()->each(function (User $user) use (&$users) {
                $users->push($user);
            });

            $userResponse->setUsers($users);
        }

        return $userResponse;
    }

    /**
     * @param string $method
     * @param string $path
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function fetchResource(string $method, string $path): array
    {
        $response = $this->httpClient->request($method, $this->getUrlFor($path));

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true);
        }

        throw new RequestException($response->getStatusCode());
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
