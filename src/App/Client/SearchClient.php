<?php

/**
 * Description of SearchClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchDocumentsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchDocumentsResult;

interface SearchClient
{
    /**
     * Ingest is asynchronous on the service side — the call returns once the
     * batch is accepted (202), not when it is indexed.
     */
    public function storeDocuments(string $accountId, StoreSearchDocumentsParams $params): void;

    /**
     * @param string[] $entityIds
     */
    public function deleteDocuments(string $accountId, string $type, array $entityIds): void;

    public function purgeAccount(string $accountId): void;

    public function purgeCompany(string $companyId): void;

    public function searchCompanyItems(string $companyId, SearchDocumentsQueryParams $params): SearchDocumentsResult;

    public function searchAccountDocuments(string $accountId, SearchDocumentsQueryParams $params): SearchDocumentsResult;
}
