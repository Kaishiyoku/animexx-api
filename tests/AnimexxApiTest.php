<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\Exception\RequestException;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class AnimexxApiTest extends TestCase
{
    use MatchesSnapshots;
    
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

    public function testFetchSerialEvent()
    {
        $id = 2154;
        $subscribers = new Collection();
        $admins = new Collection();
        $title = 'Animexx-Treffen Bayreuth';
        $city = 'Bayreuth';
        $website = '';
        $contactId = 308397;
        $attendees = '3-50';
        $period = '3';
        $slug = 'animexx-treffen-bayreuth';
        $legacyId = 2154;
        $isPassive = false;
        $created = '14.12.2018 19:44:51';
        $updated = '05.01.2019 10:15:59';
        $isAnimexx = false;
        $isHasGamesroom = false;
        $isHasKaraoke = false;
        $isHasCatering = false;
        $isHasCompetition = false;
        $isPublished = true;
        $isBanned = false;
        $status = 0;

        $serialEvent = $this->animexxApi->fetchSerialEvent($id);

        $this->assertEquals($id, $serialEvent->getId());
        $this->assertEquals($subscribers, $serialEvent->getSubscribers());
        $this->assertEquals($admins, $serialEvent->getAdmins());
        $this->assertEquals($title, $serialEvent->getTitle());
        $this->assertEquals($city, $serialEvent->getCity());
        $this->assertEquals($website, $serialEvent->getWebsite());
        $this->assertEquals($contactId, $serialEvent->getContactId());

        $this->assertMatchesSnapshot($serialEvent->getDescription());

        $this->assertEquals($attendees, $serialEvent->getAttendees());
        $this->assertEquals($period, $serialEvent->getPeriod());
        $this->assertEquals($slug, $serialEvent->getSlug());
        $this->assertEquals($legacyId, $serialEvent->getLegacyId());
        $this->assertEquals($isPassive, $serialEvent->isPassive());
        $this->assertEquals($created, $serialEvent->getCreated());
        $this->assertEquals($updated, $serialEvent->getUpdated());
        $this->assertEquals($isAnimexx, $serialEvent->isAnimexx());
        $this->assertEquals($isHasGamesroom, $serialEvent->isHasGamesroom());
        $this->assertEquals($isHasKaraoke, $serialEvent->isHasKaraoke());
        $this->assertEquals($isHasCatering, $serialEvent->isHasCatering());
        $this->assertEquals($isHasCompetition, $serialEvent->isHasCompetition());
        $this->assertEquals($isPublished, $serialEvent->isPublished());
        $this->assertEquals($isBanned, $serialEvent->isBanned());
        $this->assertEquals($status, $serialEvent->getStatus());
    }

    public function testFetchSerialEventInvalidId()
    {
        $this->expectException(ClientException::class);

        $this->animexxApi->fetchSerialEvent(-1);
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
