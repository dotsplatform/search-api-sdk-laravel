<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Response\SearchDocumentsResult;
use PHPUnit\Framework\TestCase;

class SearchDocumentsResultTest extends TestCase
{
    public function testMapsDocumentsAndIds(): void
    {
        $result = SearchDocumentsResult::fromArray([
            'documents' => [
                ['id' => 'first-id', 'type' => 'item', 'score' => null],
                ['id' => 'second-id', 'type' => 'company', 'score' => 0.9],
            ],
            'total' => 12,
            'limit' => 2,
            'offset' => 0,
        ]);

        $this->assertSame(['first-id', 'second-id'], $result->getIds());
        $this->assertSame('company', $result->getDocuments()[1]->getType());
        $this->assertSame(0.9, $result->getDocuments()[1]->getScore());
        $this->assertSame(12, $result->getTotal());
        $this->assertSame(2, $result->getLimit());
        $this->assertSame(0, $result->getOffset());
    }

    public function testEmptyResponse(): void
    {
        $result = SearchDocumentsResult::fromArray([]);

        $this->assertSame([], $result->getIds());
        $this->assertSame(0, $result->getTotal());
    }
}
