<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;

class EventType
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $color;

    /**
     * @var Collection<string>
     */
    private $events;

    /**
     * @var Collection<string>
     */
    private $eventSeries;

    /**
     * @var int
     */
    private $parent;

    /**
     * @var int
     */
    private $legacyId;

    /**
     * EventType constructor.
     */
    public function __construct()
    {
        $this->events = new Collection();
        $this->eventSeries = new Collection();
    }

    /**
     * @param array $json
     * @return EventType
     */
    public static function fromJson(array $json): EventType
    {
        $attributes = $json['attributes'];

        $eventType = new EventType();
        $eventType->id = $attributes['_id'];
        $eventType->title = $attributes['title'];
        $eventType->description = $attributes['description'];

        return $eventType;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
