<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentParams;
use Dotsplatform\SearchApiSdk\DTO\Params\StoreSearchDocumentsParams;
use PHPUnit\Framework\TestCase;

class StoreSearchDocumentsParamsTest extends TestCase
{
    public function testSerializesNestedDocuments(): void
    {
        $params = StoreSearchDocumentsParams::fromArray([
            'documents' => [
                SearchDocumentParams::fromArray([
                    'type' => 'item',
                    'entityId' => 'item-token',
                    'companyId' => 'company-token',
                    'status' => 1,
                    'updatedTime' => 1755000000,
                    'names' => ['ua' => 'Піца'],
                ]),
            ],
        ]);

        $data = $params->toArray();

        $this->assertCount(1, $data['documents']);
        $this->assertSame('item', $data['documents'][0]['type']);
        $this->assertSame('item-token', $data['documents'][0]['entityId']);
        $this->assertSame('company-token', $data['documents'][0]['companyId']);
        $this->assertSame(1755000000, $data['documents'][0]['updatedTime']);
        $this->assertSame(['ua' => 'Піца'], $data['documents'][0]['names']);
    }

    public function testDocumentPrunesNullsButKeepsFalsyValues(): void
    {
        $document = SearchDocumentParams::fromArray([
            'type' => 'item',
            'entityId' => 'item-token',
            'status' => 0,
            'priority' => 0,
        ]);

        $data = $document->toArray();

        $this->assertArrayNotHasKey('companyId', $data);
        $this->assertArrayNotHasKey('categoryId', $data);
        $this->assertArrayNotHasKey('cityId', $data);
        $this->assertArrayNotHasKey('externalId', $data);
        $this->assertArrayNotHasKey('updatedTime', $data);
        $this->assertSame(0, $data['status']);
        $this->assertSame(0, $data['priority']);
    }
}
