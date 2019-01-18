<?php

namespace Kaishiyoku\AnimexxApi\Responses;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\AnimexxApi;
use Kaishiyoku\AnimexxApi\Models\Event;
use Kaishiyoku\AnimexxApi\Models\Misc\Meta;
use Kaishiyoku\AnimexxApi\Responses\Traits\WithMeta;

class EventsResponse
{
    use WithMeta;

    /**
     * @var Collection<Event>
     */
    private $events;

    public function __construct()
    {
        $this->events = new Collection();
    }

    /**
     * @param array      $json
     * @param AnimexxApi $animexxApi
     * @return EventsResponse
     */
    public static function fromJson(array $json, AnimexxApi $animexxApi): EventsResponse
    {
        $eventsResponse = new EventsResponse();
        $eventsResponse->meta = Meta::fromJson($json['meta']);

        $events = new Collection();

        arrEach(function ($eventData) use (&$events, $animexxApi) {
            $events->push(Event::fromJson($eventData, $animexxApi));
        }, $json['data']);

        $eventsResponse->events = $events;

        return $eventsResponse;
    }

    /**
     * @return Collection
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
