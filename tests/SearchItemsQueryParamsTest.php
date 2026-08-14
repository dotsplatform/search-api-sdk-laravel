<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Params\SearchItemsQueryParams;
use PHPUnit\Framework\TestCase;

class SearchItemsQueryParamsTest extends TestCase
{
    public function testOmittedParamsArePrunedFromArray(): void
    {
        $params = SearchItemsQueryParams::fromArray(['q' => 'pizza']);

        $this->assertSame(['q' => 'pizza'], $params->toArray());
    }

    public function testBooleansAreSentAsIntegers(): void
    {
        $params = SearchItemsQueryParams::fromArray([
            'q' => 'pizza',
            'layoutCorrection' => false,
            'matchExternalCodes' => true,
        ]);

        $data = $params->toArray();

        $this->assertSame(0, $data['layoutCorrection']);
        $this->assertSame(1, $data['matchExternalCodes']);
    }

    public function testFilledParamsAreKept(): void
    {
        $params = SearchItemsQueryParams::fromArray([
            'q' => 'pizza',
            'provider' => 'eloquent',
            'fields' => ['name', 'excerpt'],
            'langScope' => 'current',
            'lang' => 'ua',
            'statuses' => [1, 2],
            'limit' => 20,
            'offset' => 40,
        ]);

        $data = $params->toArray();

        $this->assertSame('eloquent', $data['provider']);
        $this->assertSame(['name', 'excerpt'], $data['fields']);
        $this->assertSame('current', $data['langScope']);
        $this->assertSame('ua', $data['lang']);
        $this->assertSame([1, 2], $data['statuses']);
        $this->assertSame(20, $data['limit']);
        $this->assertSame(40, $data['offset']);
    }
}
