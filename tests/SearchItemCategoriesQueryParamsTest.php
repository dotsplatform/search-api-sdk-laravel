<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemCategoriesQueryParams;
use PHPUnit\Framework\TestCase;

class SearchItemCategoriesQueryParamsTest extends TestCase
{
    public function testOmittedParamsArePrunedFromArray(): void
    {
        $params = SearchItemCategoriesQueryParams::fromArray(['q' => 'торт', 'statuses' => []]);

        $this->assertSame(['q' => 'торт'], $params->toArray());
    }

    public function testFilledParamsAreKept(): void
    {
        $params = SearchItemCategoriesQueryParams::fromArray([
            'q' => 'торт',
            'provider' => 'meilisearch',
            'langs' => ['ua', 'en'],
            'statuses' => [0, 1],
            'source' => 'admin',
            'userId' => '17',
        ]);

        $this->assertSame([
            'q' => 'торт',
            'provider' => 'meilisearch',
            'langs' => ['ua', 'en'],
            'statuses' => [0, 1],
            'source' => 'admin',
            'userId' => '17',
        ], $params->toArray());
    }
}
