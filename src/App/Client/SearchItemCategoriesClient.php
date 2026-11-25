<?php

/**
 * Description of SearchItemCategoriesClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemCategoriesQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemCategoriesResult;

interface SearchItemCategoriesClient
{
    public function searchCompanyItemCategories(
        string $accountId,
        string $companyId,
        SearchItemCategoriesQueryParams $params,
    ): SearchItemCategoriesResult;
}
