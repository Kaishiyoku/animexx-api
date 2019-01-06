<?php

namespace Kaishiyoku\AnimexxApi\Models\Misc;

class Meta
{
    /**
     * @var int
     */
    private $totalItems;

    /**
     * @var int
     */
    private $itemsPerPage;

    /**
     * @param array $json
     * @return Meta
     */
    public static function fromJson(array $json): Meta
    {
        $meta = new Meta();
        $meta->totalItems = $json['totalItems'];
        $meta->itemsPerPage = $json['itemsPerPage'];

        return $meta;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
