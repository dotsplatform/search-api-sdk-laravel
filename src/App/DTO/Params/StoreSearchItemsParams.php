<?php

/**
 * Description of StoreSearchItemsParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\DTO\Params;

use Dots\Data\DTO;

class StoreSearchItemsParams extends DTO
{
    protected string $accountId;

    /** @var SearchItemDocumentParams[] */
    protected array $items = [];

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return SearchItemDocumentParams[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return [
            'accountId' => $this->accountId,
            'items' => array_map(
                fn (SearchItemDocumentParams $item) => $item->toArray(),
                $this->items,
            ),
        ];
    }
}
