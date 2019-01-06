<?php
/**
 * This file is part of the Kaishiyoku.AnimexxApi
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
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
}
