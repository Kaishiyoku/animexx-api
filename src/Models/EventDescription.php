<?php

namespace Kaishiyoku\AnimexxApi\Models;

use Illuminate\Support\Collection;

class EventDescription
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
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
     * @param array $json
     * @return EventDescription
     */
    public static function fromJson(array $json): EventDescription
    {
        // TODO: Implement fromJson() method.
    }
}
