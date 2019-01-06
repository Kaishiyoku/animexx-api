<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;

class EventSeries
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
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $contact;

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
}
