<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Exception\ClientException;
use Kaishiyoku\AnimexxApi\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class AnimexxApiTest extends TestCase
{
    /**
     * @var AnimexxApi
     */
    protected $animexxApi;

    protected function setUp()
    {
        $this->animexxApi = new AnimexxApi;
    }

    public function testIsInstanceOfAnimexxApi()
    {
        $actual = $this->animexxApi;
        $this->assertInstanceOf(AnimexxApi::class, $actual);
    }

    public function testFetchUsers()
    {
        $userResponse = $this->animexxApi->fetchUsers(1);

        $this->assertEquals($userResponse->getMeta()->getItemsPerPage(), $userResponse->getUsers()->count());
    }

    public function testFetchUsersInvalidPage()
    {
        $userResponse = $this->animexxApi->fetchUsers(9000000);

        $this->assertCount(0, $userResponse->getUsers());
    }

    public function testFetchUser()
    {
        $id = 16357;
        $legacyId = 986273;
        $username = 'Kaishiyoku';

        $user = $this->animexxApi->fetchUser($id);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($legacyId, $user->getLegacyId());
        $this->assertEquals($username, $user->getUsername());
    }
    
    public function testFetchUserInvalidId()
    {
        $this->expectException(ClientException::class);

        $this->animexxApi->fetchUser(-1);
    }

    public function testFetchSerialEvents()
    {
        $serialEventsResponse = $this->animexxApi->fetchSerialEvents(1);

        $this->assertEquals($serialEventsResponse->getMeta()->getItemsPerPage(), $serialEventsResponse->getSerialEvents()->count());
    }

    public function testFetchSerialEventsInvalidPage()
    {
        $serialEventsResponse = $this->animexxApi->fetchSerialEvents(9000000);

        $this->assertCount(0, $serialEventsResponse->getSerialEvents());
    }

    public function testFetchEventTypes()
    {
        $eventTypesResponse = $this->animexxApi->fetchEventTypes(1);
        $expected = $eventTypesResponse->getMeta()->getTotalItems() < $eventTypesResponse->getMeta()->getItemsPerPage() ? $eventTypesResponse->getMeta()->getTotalItems() : $eventTypesResponse->getMeta()->getItemsPerPage();

        $this->assertEquals($expected, $eventTypesResponse->getEventTypes()->count());
    }

    public function testFetchEventTypesInvalidPage()
    {
        $eventTypesResponse = $this->animexxApi->fetchEventTypes(9000000);

        $this->assertCount(0, $eventTypesResponse->getEventTypes());
    }
}
