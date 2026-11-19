<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemOwnersQueryParams;
use PHPUnit\Framework\TestCase;

class SearchItemOwnersQueryParamsTest extends TestCase
{
    public function testOmittedParamsArePrunedFromArray(): void
    {
        $params = SearchItemOwnersQueryParams::fromArray(['q' => 'долма', 'statuses' => []]);

        $this->assertSame(['q' => 'долма'], $params->toArray());
    }

    public function testFilledParamsAreKept(): void
    {
        $params = SearchItemOwnersQueryParams::fromArray([
            'q' => 'долма',
            'cityId' => 'city-id',
            'langs' => ['ua', 'en'],
            'statuses' => [1, 2],
            'provider' => 'meilisearch',
            'source' => 'web',
            'userId' => '17',
        ]);

        $this->assertSame([
            'q' => 'долма',
            'cityId' => 'city-id',
            'langs' => ['ua', 'en'],
            'statuses' => [1, 2],
            'provider' => 'meilisearch',
            'source' => 'web',
            'userId' => '17',
        ], $params->toArray());
    }
}
