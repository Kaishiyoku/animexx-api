<?php

namespace Kaishiyoku\AnimexxApi\Responses;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\Models\EventType;
use Kaishiyoku\AnimexxApi\Models\Misc\Meta;
use Kaishiyoku\AnimexxApi\Responses\Traits\WithMeta;

class EventTypesResponse
{
    use WithMeta;

    /**
     * @var Collection<EventType>
     */
    private $eventTypes;

    /**
     * @param array $json
     * @return EventTypesResponse
     */
    public static function fromJson(array $json): EventTypesResponse
    {
        $eventTypesResponse = new EventTypesResponse();
        $eventTypesResponse->meta = Meta::fromJson($json['meta']);

        $eventTypes = new Collection();

        arrEach(function ($eventTypeData) use (&$eventTypes) {
            $eventTypes->push(EventType::fromJson($eventTypeData));
        }, $json['data']);

        $eventTypesResponse->eventTypes = $eventTypes;

        return $eventTypesResponse;
    }

    /**
     * @return Collection
     */
    public function getEventTypes(): Collection
    {
        return $this->eventTypes;
    }
    
    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
