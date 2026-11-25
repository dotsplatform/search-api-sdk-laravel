<?php

namespace Tests;

use Dotsplatform\SearchApiSdk\DTO\Response\SearchItemCategoriesResult;
use PHPUnit\Framework\TestCase;

class SearchItemCategoriesResultTest extends TestCase
{
    public function testMapsCategoryIdsAndProvider(): void
    {
        $result = SearchItemCategoriesResult::fromArray([
            'categoryIds' => ['first-category', 'second-category'],
            'respondedProvider' => 'meilisearch',
        ]);

        $this->assertSame(['first-category', 'second-category'], $result->getCategoryIds());
        $this->assertSame('meilisearch', $result->getRespondedProvider());
    }

    public function testSkipsNonStringCategoryIds(): void
    {
        $result = SearchItemCategoriesResult::fromArray([
            'categoryIds' => ['first-category', 17, null, ['nested']],
        ]);

        $this->assertSame(['first-category'], $result->getCategoryIds());
    }

    public function testEmptyResponse(): void
    {
        $result = SearchItemCategoriesResult::fromArray([]);

        $this->assertSame([], $result->getCategoryIds());
        $this->assertNull($result->getRespondedProvider());
    }
}
