<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Exception\GuzzleException;
use Kaishiyoku\AnimexxApi\Exception\RequestException;
use Kaishiyoku\AnimexxApi\Models\EventType;
use Kaishiyoku\AnimexxApi\Models\SerialEvent;
use Kaishiyoku\AnimexxApi\Models\User;
use Kaishiyoku\AnimexxApi\Responses\EventDescriptionsResponse;
use Kaishiyoku\AnimexxApi\Responses\EventTypesResponse;
use Kaishiyoku\AnimexxApi\Responses\SerialEventsResponse;
use Kaishiyoku\AnimexxApi\Responses\UsersResponse;

class AnimexxApi
{
    private const BASE_URL = 'https://rewind.animexx.de/api';

    private $httpFetcher;

    public function __construct()
    {
        $this->httpFetcher = new HttpFetcher(self::BASE_URL);
    }

    /**
     * @param int $page
     * @return UsersResponse
     * @throws GuzzleException
     */
    public function fetchUsers(int $page): UsersResponse
    {
        $json = $this->httpFetcher->fetchResource('get', '/users/?page=' . $page);

        return UsersResponse::fromJson($json);
    }

    /**
     * @param int $id
     * @return User
     * @throws GuzzleException
     */
    public function fetchUser(int $id): User
    {
        $json = $this->httpFetcher->fetchResource('get', '/users/' . $id);

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
        $json = $this->httpFetcher->fetchResource('get', '/event-series/?page=' . $page);

        return SerialEventsResponse::fromJson($json, $this);
    }

    /**
     * @param int $id
     * @return SerialEvent
     * @throws GuzzleException
     */
    public function fetchSerialEvent(int $id): SerialEvent
    {
        $json = $this->httpFetcher->fetchResource('get', '/event-series/' . $id);

        return SerialEvent::fromJson($json['data'], $this);
    }

    /**
     * @param int $page
     * @return EventTypesResponse
     * @throws GuzzleException
     */
    public function fetchEventTypes(int $page): EventTypesResponse
    {
        $json = $this->httpFetcher->fetchResource('get', '/event-types?page=' . $page);

        return EventTypesResponse::fromJson($json);
    }

    /**
     * @param int $id
     * @return EventType
     * @throws GuzzleException
     */
    public function fetchEventType(int $id) : EventType
    {
        $json = $this->httpFetcher->fetchResource('get', '/event-types/' . $id);

        return EventType::fromJson($json['data']);
    }

    public function fetchEventDescriptions(int $page) : EventDescriptionsResponse
    {
        $json = $this->httpFetcher->fetchResource('get', '/event-descriptions?page=' . $page);

        return EventDescriptionsResponse::fromJson($json, $this);
    }
}
