<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemDocumentParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchItemsParams;
use PHPUnit\Framework\TestCase;

class StoreSearchItemsParamsTest extends TestCase
{
    public function testSerializesNestedDocuments(): void
    {
        $params = StoreSearchItemsParams::fromArray([
            'accountId' => 'account-token',
            'items' => [
                SearchItemDocumentParams::fromArray([
                    'id' => 'item-token',
                    'status' => 0,
                    'popular' => false,
                    'names' => ['ua' => 'Піца'],
                ]),
            ],
        ]);

        $data = $params->toArray();

        $this->assertSame('account-token', $data['accountId']);
        $this->assertCount(1, $data['items']);
        $this->assertSame('item-token', $data['items'][0]['id']);
        $this->assertSame(['ua' => 'Піца'], $data['items'][0]['names']);
    }

    public function testDocumentPrunesNullsButKeepsFalsyValues(): void
    {
        $document = SearchItemDocumentParams::fromArray([
            'id' => 'item-token',
            'status' => 0,
            'popular' => false,
            'priority' => 0,
        ]);

        $data = $document->toArray();

        $this->assertArrayNotHasKey('categoryId', $data);
        $this->assertArrayNotHasKey('externalId', $data);
        $this->assertSame(0, $data['status']);
        $this->assertFalse($data['popular']);
        $this->assertSame(0, $data['priority']);
    }
}
