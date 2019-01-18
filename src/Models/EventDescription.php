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
     * @var Event
     */
    private $event;

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
     * @param array      $json
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

        callIfKeyExists(function () use ($animexxApi, &$event, $json) {
            $event = $animexxApi->fetchEvent(filterInt($json['relationships']['event']['data']['id']));
        }, 'relationships', $json);

        $eventDescription->event = $event;

        return $eventDescription;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->isHtml;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return Collection
     */
    public function getEventDescriptionDocuments(): Collection
    {
        return $this->eventDescriptionDocuments;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
