<?php

namespace Tests;

use Dotsplatform\CatalogSearchApiSdk\DTO\Response\SearchItemsResult;
use PHPUnit\Framework\TestCase;

class SearchItemsResultTest extends TestCase
{
    public function testMapsItemsAndIds(): void
    {
        $result = SearchItemsResult::fromArray([
            'items' => [
                ['id' => 'first-id', 'score' => null],
                ['id' => 'second-id', 'score' => 0.9],
            ],
            'total' => 12,
            'limit' => 2,
            'offset' => 0,
        ]);

        $this->assertSame(['first-id', 'second-id'], $result->getIds());
        $this->assertSame(0.9, $result->getItems()[1]->getScore());
        $this->assertSame(12, $result->getTotal());
        $this->assertSame(2, $result->getLimit());
        $this->assertSame(0, $result->getOffset());
    }

    public function testEmptyResponse(): void
    {
        $result = SearchItemsResult::fromArray([]);

        $this->assertSame([], $result->getIds());
        $this->assertSame(0, $result->getTotal());
    }
}
