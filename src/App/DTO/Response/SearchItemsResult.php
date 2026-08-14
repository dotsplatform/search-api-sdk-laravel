<?php

/**
 * Description of SearchItemsResult.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\DTO\Response;

use Dots\Data\DTO;

class SearchItemsResult extends DTO
{
    /** @var array[] raw `{id, score}` rows as returned by the service */
    protected array $items = [];

    protected int $total = 0;

    protected int $limit = 0;

    protected int $offset = 0;

    /**
     * @return FoundSearchItem[]
     */
    public function getItems(): array
    {
        $items = [];
        foreach ($this->items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $items[] = FoundSearchItem::fromArray($item);
        }

        return $items;
    }

    /**
     * Found item ids (dish tokens) in relevance order.
     *
     * @return string[]
     */
    public function getIds(): array
    {
        $ids = [];
        foreach ($this->getItems() as $item) {
            $ids[] = $item->getId();
        }

        return $ids;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
