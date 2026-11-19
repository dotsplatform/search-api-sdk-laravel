<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemOwnersResult;
use PHPUnit\Framework\TestCase;

class SearchItemOwnersResultTest extends TestCase
{
    public function testOwnerIdsAreReturnedInServiceOrder(): void
    {
        $result = SearchItemOwnersResult::fromArray(['ownerIds' => ['c1', 'm2']]);

        $this->assertSame(['c1', 'm2'], $result->getOwnerIds());
    }

    public function testNonStringOwnerIdsAreIgnored(): void
    {
        $result = SearchItemOwnersResult::fromArray(['ownerIds' => ['c1', 7, null, ['x']]]);

        $this->assertSame(['c1'], $result->getOwnerIds());
    }

    public function testMissingOwnerIdsMeanNoOwners(): void
    {
        $result = SearchItemOwnersResult::fromArray([]);

        $this->assertSame([], $result->getOwnerIds());
    }
}
