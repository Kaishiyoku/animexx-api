<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;
use function Kaishiyoku\AnimexxApi\filterInt;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $legacyId;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var @string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $roles;

    private $equalTo;

    /**
     * @var Collection<string>
     */
    private $events;

    /**
     * @var Collection<EventSeries>
     */
    private $subscribedEventSeries;

    /**
     * @var Collection<string>
     */
    private $subscribedEvent;

    /**
     * @var Collection<string>
     */
    private $interestedEvents;

    /**
     * @var string
     */
    private $userSetting;

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

    public static function fromJson($json)
    {
        $attributes = $json['attributes'];

        $user = new User();
        $user->id = $attributes['_id'];
        $user->legacyId = $attributes['legacyId'];
        $user->username = $attributes['username'];

        return $user;
    }
}
