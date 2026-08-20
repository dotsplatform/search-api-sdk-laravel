<?php

/**
 * Description of StoreSearchDocumentsParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

class StoreSearchDocumentsParams extends DTO
{
    /** @var SearchDocumentParams[] */
    protected array $documents = [];

    /**
     * @return SearchDocumentParams[]
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    public function toArray(): array
    {
        return [
            'documents' => array_map(
                fn (SearchDocumentParams $document) => $document->toArray(),
                $this->documents,
            ),
        ];
    }
}
