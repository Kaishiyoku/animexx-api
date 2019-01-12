<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;
use Kaishiyoku\AnimexxApi\AnimexxApi;

class EventDescription
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collection<Event>
     */
    private $events;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $isHtml;

    /**
     * @var int
     */
    private $page;

    /**
     * @var Collection<string>
     */
    private $eventDescriptionDocuments;

    /**
     * @var string
     */
    private $title;

    /**
     * EventDescription constructor.
     */
    public function __construct()
    {
        $this->eventDescriptionDocuments = new Collection();
    }

    /**
     * @param array $json
     * @param AnimexxApi $animexxApi
     * @return EventDescription
     */
    public static function fromJson(array $json, AnimexxApi $animexxApi): EventDescription
    {
        $attributes = $json['attributes'];

        $eventDescription = new EventDescription();
        $eventDescription->id = $attributes['_id'];
        $eventDescription->locale = $attributes['locale'];
        $eventDescription->content = $attributes['content'];
        $eventDescription->isHtml = $attributes['isHtml'];
        $eventDescription->page = $attributes['page'];
        $eventDescription->eventDescriptionDocuments = new Collection($attributes['eventDescriptionDocuments']);
        $eventDescription->title = $attributes['title'];

        $events = new Collection();

        callIfKeyExists(function () use ($animexxApi, &$events, $attributes) {
            arrEach(function ($item) use ($animexxApi, &$events) {
                $event = $animexxApi->fetchEvent(filterInt($item['id']));

                $events->push($event);
            }, $attributes['relationships']['event']);
        }, 'relationships', $attributes);

        $eventDescription->events = $events;

        return $eventDescription;
    }
}
