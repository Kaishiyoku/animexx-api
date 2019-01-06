<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;

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
}
