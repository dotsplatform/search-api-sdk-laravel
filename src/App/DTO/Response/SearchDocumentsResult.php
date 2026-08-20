<?php

/**
 * Description of SearchDocumentsResult.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Response;

use Dots\Data\DTO;

class SearchDocumentsResult extends DTO
{
    /** @var array[] raw `{id, type, score}` rows as returned by the service */
    protected array $documents = [];

    protected int $total = 0;

    protected int $limit = 0;

    protected int $offset = 0;

    /**
     * @return FoundDocument[]
     */
    public function getDocuments(): array
    {
        $documents = [];
        foreach ($this->documents as $document) {
            if (! is_array($document)) {
                continue;
            }

            $documents[] = FoundDocument::fromArray($document);
        }

        return $documents;
    }

    /**
     * Found entity ids in relevance order.
     *
     * @return string[]
     */
    public function getIds(): array
    {
        $ids = [];
        foreach ($this->getDocuments() as $document) {
            $ids[] = $document->getId();
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
