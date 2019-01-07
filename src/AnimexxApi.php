<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Kaishiyoku\AnimexxApi\Exception\RequestException;
use Kaishiyoku\AnimexxApi\Models\User;
use Kaishiyoku\AnimexxApi\Responses\EventTypesResponse;
use Kaishiyoku\AnimexxApi\Responses\SerialEventsResponse;
use Kaishiyoku\AnimexxApi\Responses\UsersResponse;

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
     * @return UsersResponse
     * @throws GuzzleException
     */
    public function fetchUsers(int $page): UsersResponse
    {
        $json = $this->fetchResource('get', '/users/?page=' . $page);

        return UsersResponse::fromJson($json);
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
     * @param int $page
     * @return SerialEventsResponse
     * @throws GuzzleException
     */
    public function fetchSerialEvents(int $page): SerialEventsResponse
    {
        // TODO: add filter ability:
        //       - id
        //       - id[]
        //       - slug
        //       - sluig[]
        //       - city
        $json = $this->fetchResource('get', '/event-series/?page=' . $page);

        return SerialEventsResponse::fromJson($json, $this);
    }

    /**
     * @param int $page
     * @return EventTypesResponse
     * @throws GuzzleException
     */
    public function fetchEventTypes(int $page): EventTypesResponse
    {
        $json = $this->fetchResource('get', '/event-types?page=' . $page);

        return EventTypesResponse::fromJson($json);
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
