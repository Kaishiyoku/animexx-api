<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\AnimexxApi;

class SerialEvent
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string|null
     */
    private $website;

    /**
     * @var int
     */
    private $contactId;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $attendees;

    /**
     * @var Collection<string>
     */
    private $events;

    /**
     * @var Collection<string>
     */
    private $subscribers;

    /**
     * @var string
     */
    private $period;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Collection<string>
     */
    private $admins;

    /**
     * @var int
     */
    private $legacyId;

    /**
     * @var bool
     */
    private $isPassive;

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
    private $isPublished;

    /**
     * @var bool
     */
    private $isBanned;

    /**
     * @var int
     */
    private $status;

    public function __construct()
    {
        $this->events = new Collection();
        $this->subscribers = new Collection();
        $this->admins = new Collection();
    }

    /**
     * @param array      $json
     * @param AnimexxApi $animexxApi
     * @return SerialEvent
     */
    public static function fromJson(array $json, AnimexxApi $animexxApi): SerialEvent
    {
        $attributes = $json['attributes'];

        $serialEvent = new SerialEvent();
        $serialEvent->id = $attributes['_id'];
        $serialEvent->title = $attributes['title'];
        $serialEvent->city = $attributes['city'];
        $serialEvent->website = $attributes['website'];
        $serialEvent->contactId = filterInt($attributes['contact']);
        $serialEvent->description = $attributes['description'];
        $serialEvent->attendees = $attributes['attendees'];
        $serialEvent->period = $attributes['period'];
        $serialEvent->slug = $attributes['slug'];
        $serialEvent->legacyId = $attributes['legacyId'];
        $serialEvent->isPassive = $attributes['isPassive'];
        $serialEvent->created = $attributes['created'];
        $serialEvent->updated = $attributes['updated'];
        $serialEvent->isAnimexx = $attributes['animexx'] !== 0;
        $serialEvent->hasGamesroom = $attributes['hasGamesroom'];
        $serialEvent->hasKaraoke = $attributes['hasKaraoke'];
        $serialEvent->hasCatering = $attributes['hasCatering'];
        $serialEvent->hasCompetition = $attributes['hasCompetition'];
        $serialEvent->isPublished = $attributes['published'];
        $serialEvent->isBanned = $attributes['banned'];
        $serialEvent->status = $attributes['status'];

        // TODO: $events: relationships.events.data: [type, id(intval)]

        $userIdMapper = function ($item) use ($animexxApi) {
            return $animexxApi->fetchUser(filterInt($item['id']));
        };

        callIfKeyExists(function () use (&$serialEvent, &$userIdMapper, &$attributes) {
            $serialEvent->subscribers = arrMap($userIdMapper, $attributes['subscribers']['data']);
        }, 'subscribers', $attributes);
        
        // TODO: $type: _type.data.id(intval)

        callIfKeyExists(function () use (&$serialEvent, &$userIdMapper, &$attributes) {
            $serialEvent->admins = arrMap($userIdMapper, $attributes['admins']['data']);
        }, 'admins', $attributes);

        return $serialEvent;
    }

    /**
     * @return Collection
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    /**
     * @return Collection
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return int
     */
    public function getContactId(): int
    {
        return $this->contactId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
    public function getPeriod(): string
    {
        return $this->period;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getLegacyId(): int
    {
        return $this->legacyId;
    }

    /**
     * @return bool
     */
    public function isPassive(): bool
    {
        return $this->isPassive;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    /**
     * @return bool
     */
    public function isAnimexx(): bool
    {
        return $this->isAnimexx;
    }

    /**
     * @return bool
     */
    public function isHasGamesroom(): bool
    {
        return $this->hasGamesroom;
    }

    /**
     * @return bool
     */
    public function isHasKaraoke(): bool
    {
        return $this->hasKaraoke;
    }

    /**
     * @return bool
     */
    public function isHasCatering(): bool
    {
        return $this->hasCatering;
    }

    /**
     * @return bool
     */
    public function isHasCompetition(): bool
    {
        return $this->hasCompetition;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->isBanned;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
