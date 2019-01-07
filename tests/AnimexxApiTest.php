<?php

namespace Kaishiyoku\AnimexxApi;

use PHPUnit\Framework\TestCase;

class AnimexxApiTest extends TestCase
{
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
}
