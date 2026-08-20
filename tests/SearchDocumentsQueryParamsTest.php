<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchDocumentsQueryParams;
use PHPUnit\Framework\TestCase;

class SearchDocumentsQueryParamsTest extends TestCase
{
    public function testOmittedParamsArePrunedFromArray(): void
    {
        $params = SearchDocumentsQueryParams::fromArray(['q' => 'pizza']);

        $this->assertSame(['q' => 'pizza'], $params->toArray());
    }

    public function testFilledParamsAreKept(): void
    {
        $params = SearchDocumentsQueryParams::fromArray([
            'q' => 'pizza',
            'provider' => 'eloquent',
            'types' => ['item', 'company'],
            'cityId' => 'city-id',
            'companyId' => 'company-id',
            'langs' => ['ua', 'en'],
            'statuses' => [1, 2],
            'categoryId' => 'category-id',
            'sortField' => 'name',
            'sortDirection' => 'desc',
            'limit' => 20,
            'offset' => 40,
            'source' => 'admin',
            'userId' => '17',
        ]);

        $data = $params->toArray();

        $this->assertSame('eloquent', $data['provider']);
        $this->assertSame(['item', 'company'], $data['types']);
        $this->assertSame('city-id', $data['cityId']);
        $this->assertSame('company-id', $data['companyId']);
        $this->assertSame(['ua', 'en'], $data['langs']);
        $this->assertSame([1, 2], $data['statuses']);
        $this->assertSame('category-id', $data['categoryId']);
        $this->assertSame('name', $data['sortField']);
        $this->assertSame('desc', $data['sortDirection']);
        $this->assertSame(20, $data['limit']);
        $this->assertSame(40, $data['offset']);
        $this->assertSame('admin', $data['source']);
        $this->assertSame('17', $data['userId']);
    }

    public function testEmptyListsArePruned(): void
    {
        $params = SearchDocumentsQueryParams::fromArray([
            'q' => 'pizza',
            'types' => [],
            'langs' => [],
        ]);

        $data = $params->toArray();

        $this->assertArrayNotHasKey('types', $data);
        $this->assertArrayNotHasKey('langs', $data);
    }
}
