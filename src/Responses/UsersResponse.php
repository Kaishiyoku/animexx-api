<?php

namespace Kaishiyoku\AnimexxApi\Responses;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\Models\Misc\Meta;
use Kaishiyoku\AnimexxApi\Models\User;
use Kaishiyoku\AnimexxApi\Responses\Traits\WithMeta;

class UsersResponse
{
    use WithMeta;

    /**
     * @var Collection<User>
     */
    private $users;

    /**
     * UsersResponse constructor.
     */
    public function __construct()
    {
        $this->users = new Collection();
    }

    /**
     * @param array $json
     * @return UsersResponse
     */
    public static function fromJson(array $json): UsersResponse
    {
        $userResponse = new UsersResponse();
        $userResponse->meta = Meta::fromJson($json['meta']);

        $users = new Collection();

        arrEach(function ($userData) use (&$users) {
            $users->push(User::fromJson($userData));
        }, $json['data']);

        $userResponse->users = $users;

        return $userResponse;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
