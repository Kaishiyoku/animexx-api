<?php

namespace Kaishiyoku\AnimexxApi\Responses;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\AnimexxApi;
use Kaishiyoku\AnimexxApi\Models\EventDescription;
use Kaishiyoku\AnimexxApi\Models\EventType;
use Kaishiyoku\AnimexxApi\Models\Misc\Meta;
use Kaishiyoku\AnimexxApi\Responses\Traits\WithMeta;

class EventDescriptionsResponse
{
    use WithMeta;

    /**
     * @var Collection<EventDescription>
     */
    private $eventDescriptions;

    public function __construct()
    {
        $this->eventDescriptions = new Collection();
    }

    /**
     * @param array      $json
     * @param AnimexxApi $animexxApi
     * @return EventDescriptionsResponse
     */
    public static function fromJson(array $json, AnimexxApi $animexxApi): EventDescriptionsResponse
    {
        $eventDescriptionsResponse = new EventDescriptionsResponse();
        $eventDescriptionsResponse->meta = Meta::fromJson($json['meta']);

        $eventDescriptions = new Collection();

        arrEach(function ($eventDescriptionData) use (&$eventDescriptions, $animexxApi) {
            $eventDescriptions->push(EventDescription::fromJson($eventDescriptionData, $animexxApi));
        }, $json['data']);

        $eventDescriptionsResponse->eventDescriptions = $eventDescriptions;

        return $eventDescriptionsResponse;
    }

    /**
     * @return Collection
     */
    public function getEventDescriptions(): Collection
    {
        return $this->eventDescriptions;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
