<?php

namespace Kaishiyoku\AnimexxApi\Responses;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\Models\Misc\Meta;
use Kaishiyoku\AnimexxApi\Models\User;
use Kaishiyoku\AnimexxApi\Responses\Traits\WithMeta;

class UserResponse
{
    use WithMeta;

    /**
     * @var Collection<User>
     */
    private $users;

    /**
     * @param array $json
     * @return UserResponse
     */
    public static function fromJson(array $json): UserResponse
    {
        $userResponse = new UserResponse();
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
     * @param Collection $users
     */
    public function setUsers(Collection $users): void
    {
        $this->users = $users;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
