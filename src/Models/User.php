<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;

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
     * @var string
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
     * @var Collection<SerialEvent>
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

    /**
     * @param array $json
     * @return User
     */
    public static function fromJson(array $json): User
    {
        $attributes = $json['attributes'];

        $user = new User();
        $user->id = $attributes['_id'];
        $user->legacyId = $attributes['legacyId'];
        $user->username = $attributes['username'];

        return $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLegacyId(): int
    {
        return $this->legacyId;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
