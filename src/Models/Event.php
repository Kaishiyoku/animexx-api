<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\AnimexxApi;

class Event
{
    private $googleCalendarLink;

    /**
     * @var string
     */
    private $helper;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $dateStart;

    /**
     * @var string
     */
    private $dateEnd;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var bool
     */
    private $isFeatured;

    /**
     * @var string
     */
    private $hashtags;

    /**
     * @var string
     */
    private $series;

    /**
     * @var EventType
     */
    private $type;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var string
     */
    private $attendees;

    /**
     * @var Collection<User>
     */
    private $participants;

    /**
     * @var Collection<User>
     */
    private $interested;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $intro;

    /**
     * @var Collection<Event>
     */
    private $subEvents;

    /**
     * @var Event
     */
    private $parent;

    /**
     * @var bool
     */
    private $isCancelled;

    /**
     * @var string
     */
    private $mainImage;

    /**
     * @var string
     */
    private $logoImage;

    /**
     * @var Collection<string>
     */
    private $userGroups;

    /**
     * @var Collection<string>
     */
    private $carpoolOffers;

    /**
     * @var Collection<string>
     */
    private $carpoolRequests;

    /**
     * @var Collection<string>
     */
    private $accommodationOffers;

    /**
     * @var Collection<User>
     */
    private $admins;

    /**
     * @var string
     */
    private $thread;

    /**
     * @var bool
     */
    private $isHighlight;

    /**
     * @var bool
     */
    private $isPrivate;

    /**
     * @var Collection<string>
     */
    private $descriptions;

    /**
     * @var string
     */
    private $country;

    /**
     * @var Collection<string>
     */
    private $eventStaff;

    /**
     * @var Collection<string>
     */
    private $eventEns;

    /**
     * @var int
     */
    private $legacyId;

    /**
     * @var int
     */
    private $animexx;

    /**
     * @var bool
     */
    private $isAnimexx;

    /**
     * @var bool
     */
    private $hasGamesroom;

    /**
     * @var bool
     */
    private $hasKaraoke;

    /**
     * @var bool
     */
    private $hasCatering;

    /**
     * @var bool
     */
    private $hasCompetition;

    /**
     * @var bool
     */
    private $published;

    /**
     * @var bool
     */
    private $isPublished;

    /**
     * @var bool
     */
    private $banned;

    /**
     * @var bool
     */
    private $isBanned;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $created;

    /**
     * @var string
     */
    private $updated;

    /**
     * @var string
     */
    private $geoLat;

    /**
     * @var string
     */
    private $geoLong;

    /**
     * @var int
     */
    private $geoZoom;

    /**
     * @var int
     */
    private $geoType;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->participants = new Collection();
        $this->interested = new Collection();
        $this->subEvents = new Collection();
        $this->userGroups = new Collection();
        $this->carpoolOffers = new Collection();
        $this->carpoolRequests = new Collection();
        $this->accommodationOffers = new Collection();
        $this->admins = new Collection();
        $this->descriptions = new Collection();
        $this->eventStaff = new Collection();
        $this->eventEns = new Collection();
    }

    /**
     * @param array      $json
     * @param AnimexxApi $animexxApi
     * @return Event
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function fromJson(array $json, AnimexxApi $animexxApi): Event
    {
        $attributes = $json['attributes'];
        $relationships = $json['relationships'];

        $event = new Event();
        $event->id = $attributes['_id'];
        $event->name = $attributes['name'];
        $event->slug = $attributes['slug'];
        $event->dateStart = $attributes['dateStart'];
        $event->dateEnd = $attributes['dateEnd'];
        $event->address = $attributes['address'];
        $event->zip = $attributes['zip'];
        $event->city = $attributes['city'];
        $event->state = $attributes['state'];
        $event->host = $attributes['host'];
        $event->contact = $attributes['contact'];
        $event->isFeatured = $attributes['isFeatured'];
        $event->hashtags = $attributes['hashtags'];
        $event->isCancelled = $attributes['isCancelled'];
        $event->duration = $attributes['duration'];
        $event->attendees = $attributes['attendees'];
        $event->website = $attributes['website'];
        $event->intro = $attributes['intro'];

        $event->type = $animexxApi->fetchEventType(filterInt($relationships['_type']['data']['id']));

        $userIdMapper = function ($item) use ($animexxApi) {
            return $animexxApi->fetchUser(filterInt($item['id']));
        };

        callIfKeyExists(function () use (&$event, &$userIdMapper, &$relationships) {
            $event->participants = new Collection(arrMap($userIdMapper, $relationships['participants']['data']));
        }, 'participants', $relationships);

        return $event;
    }

    /**
     * @return EventType
     */
    public function getType(): EventType
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->isFeatured;
    }

    /**
     * @return string
     */
    public function getHashtags(): string
    {
        return $this->hashtags;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getAttendees(): string
    {
        return $this->attendees;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->isCancelled;
    }

    /**
     * @return Collection
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }
}
