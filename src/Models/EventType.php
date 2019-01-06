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
}
