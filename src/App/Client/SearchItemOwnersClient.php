<?php

/**
 * Description of SearchItemOwnersClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemOwnersQueryParams;
use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemOwnersResult;

interface SearchItemOwnersClient
{
    public function searchAccountItemOwners(string $accountId, SearchItemOwnersQueryParams $params): SearchItemOwnersResult;
}
