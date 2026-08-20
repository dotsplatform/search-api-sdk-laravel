<?php

/**
 * Description of SuccessSearchStubClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentsQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchDocumentsParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchDocumentsResult;

class SuccessSearchStubClient implements SearchClient
{
    public function storeDocuments(string $accountId, StoreSearchDocumentsParams $params): void
    {
    }

    public function deleteDocuments(string $accountId, string $type, array $entityIds): void
    {
    }

    public function purgeAccount(string $accountId): void
    {
    }

    public function purgeCompany(string $companyId): void
    {
    }

    public function searchCompanyItems(string $companyId, SearchDocumentsQueryParams $params): SearchDocumentsResult
    {
        return $this->makeEmptyResult($params);
    }

    public function searchAccountDocuments(string $accountId, SearchDocumentsQueryParams $params): SearchDocumentsResult
    {
        return $this->makeEmptyResult($params);
    }

    private function makeEmptyResult(SearchDocumentsQueryParams $params): SearchDocumentsResult
    {
        return SearchDocumentsResult::fromArray([
            'documents' => [],
            'total' => 0,
            'limit' => $params->getLimit() ?? 0,
            'offset' => $params->getOffset() ?? 0,
        ]);
    }
}
