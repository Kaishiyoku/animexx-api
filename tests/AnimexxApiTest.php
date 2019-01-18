<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\Exception\RequestException;
use Kaishiyoku\AnimexxApi\Models\User;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class AnimexxApiTest extends TestCase
{
    use MatchesSnapshots;
    
    /**
     * @var AnimexxApi
     */
    protected $animexxApi;

    protected $arr = [
        'a' => [
            'aa' => 'AA value',
        ],
        'b' => 'B value',
        'c' => [
            'cc' => 'CC value',
            'cc2' => [
                'ccc' => 'CCC value',
                'ccc2' => 'CCC2 value',
            ],
        ],
    ];

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

    public function testFetchEventType()
    {
        $id = 6;
        $title = 'Messe / Großveranstaltung';
        $description = null;

        $eventType = $this->animexxApi->fetchEventType($id);

        $this->assertEquals($id, $eventType->getId());
        $this->assertEquals($title, $eventType->getTitle());
        $this->assertEquals($description, $eventType->getDescription());
    }

    public function testFetchEventTypeInvalidId()
    {
        $this->expectException(ClientException::class);

        $this->animexxApi->fetchEventType(-1);
    }

    public function testFetchEventDescriptions()
    {
        $eventDescriptionsResponse = $this->animexxApi->fetchEventDescriptions(1);

        $this->assertEquals($eventDescriptionsResponse->getMeta()->getItemsPerPage(), $eventDescriptionsResponse->getEventDescriptions()->count());
    }

    public function testFetchEventDescriptionsInvalidPage()
    {
        $eventDescriptionsResponse = $this->animexxApi->fetchEventDescriptions(9000000);

        $this->assertCount(0, $eventDescriptionsResponse->getEventDescriptions());
    }

    public function testFetchEventDescription()
    {
        $id = 12958;
        $locale = 'de';
        $isHtml = true;
        $page = 1;
        $eventDescriptionDocuments = new Collection();
        $title = 'Allgemein';

        $event = $this->animexxApi->fetchEvent(74648);

        $eventDescription = $this->animexxApi->fetchEventDescription($id);

        $this->assertEquals($id, $eventDescription->getId());
        $this->assertEquals($locale, $eventDescription->getLocale());
        $this->assertMatchesSnapshot($eventDescription->getContent());
        $this->assertEquals($isHtml, $eventDescription->isHtml());
        $this->assertEquals($page, $eventDescription->getPage());
        $this->assertCount($eventDescriptionDocuments->count(), $eventDescription->getEventDescriptionDocuments());
        $this->assertEquals($title, $eventDescription->getTitle());

        $this->assertEquals($event->getId(), $eventDescription->getEvent()->getId());
    }

    public function testFetchEventDescriptionInvalidId()
    {
        $this->expectException(ClientException::class);

        $this->animexxApi->fetchEventDescription(-1);
    }

    public function testFetchEvents()
    {
        $eventsResponse = $this->animexxApi->fetchEvents(1);

        $this->assertEquals($eventsResponse->getMeta()->getItemsPerPage(), $eventsResponse->getEvents()->count());
    }

    public function testFetchEvent()
    {
        $id = 59455;
        $name = 'BRAWL ONE HAMBURG - Fighting Game Turnier #1';
        $slug = 'brawl-one-hamburg---fighting-game-turnier-1';
        $dateStart = '-0001-11-30T00:00:00+01:00';
        $dateEnd = '-0001-11-30T00:00:00+01:00';
        $address = '';
        $zip = '';
        $city = 'Hamburg';
        $state = 'DE-HH';
        $host = '';
        $contact = '[[USERID=421436 (RoCkHoWaRd)]]';
        $isFeatured = false;
        $hashtags = '';
        $duration = 0;
        $attendees = 'k/A';
        $website = '';
        $intro = '';
        $isCancelled = false;
        $participants = new Collection([
            $this->animexxApi->fetchUser(150926),
            $this->animexxApi->fetchUser(192758),
            $this->animexxApi->fetchUser(21532),
            $this->animexxApi->fetchUser(22281),
            $this->animexxApi->fetchUser(143137),
            $this->animexxApi->fetchUser(9586),
        ]);

        $participantsMapper = function (User $user) {
            return $user->getId();
        };

        $event = $this->animexxApi->fetchEvent($id);

        $this->assertEquals($id, $event->getId());
        $this->assertEquals($name, $event->getName());
        $this->assertEquals($slug, $event->getSlug());
        $this->assertEquals($dateStart, $event->getDateStart());
        $this->assertEquals($dateEnd, $event->getDateEnd());
        $this->assertEquals($address, $event->getAddress());
        $this->assertEquals($zip, $event->getZip());
        $this->assertEquals($city, $event->getCity());
        $this->assertEquals($state, $event->getState());
        $this->assertEquals($host, $event->getHost());
        $this->assertEquals($contact, $event->getContact());
        $this->assertEquals($isFeatured, $event->isFeatured());
        $this->assertEquals($hashtags, $event->getHashtags());
        $this->assertEquals($duration, $event->getDuration());
        $this->assertEquals($attendees, $event->getAttendees());
        $this->assertEquals($website, $event->getWebsite());
        $this->assertEquals($intro, $event->getIntro());
        $this->assertEquals($isCancelled, $event->isCancelled());
        $this->assertEquals(13, $event->getType()->getId());
        $this->assertEquals($participants->map($participantsMapper)->toArray(), $event->getParticipants()->map($participantsMapper)->toArray());
    }

    public function testCallIfKeyExists()
    {
        $valueA = false;
        callIfKeyExists(function () use (&$valueA) {
             $valueA = true;
        }, 'a.aa', $this->arr);
        $this->assertTrue($valueA);

        $valueB = false;
        callIfKeyExists(function () use (&$valueB) {
            $valueB = true;
        }, 'b', $this->arr);
        $this->assertTrue($valueB);

        $valueC = false;
        callIfKeyExists(function () use (&$valueC) {
            $valueC = true;
        }, 'c.cc2.ccc', $this->arr);
        $this->assertTrue($valueC);

        $valueCNonexistent = false;
        callIfKeyExists(function () use (&$valueCNonexistent) {
            $valueCNonexistent = true;
        }, 'c.cc3', $this->arr);
        $this->assertfalse($valueCNonexistent);
    }

    public function testArrGet()
    {
        $valueA = arrGet('a.aa', $this->arr);
        $this->assertEquals('AA value', $valueA);

        $valueB = arrGet('b', $this->arr);
        $this->assertEquals('B value', $valueB);

        $valueC = arrGet('c.cc2.ccc', $this->arr);
        $this->assertEquals('CCC value', $valueC);

        $valueCNonexistent = arrGet('c.cc3', $this->arr);
        $this->assertEquals(null, $valueCNonexistent);
    }
}
