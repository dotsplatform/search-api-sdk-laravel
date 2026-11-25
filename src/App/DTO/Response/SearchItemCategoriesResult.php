<?php

/**
 * Description of SearchItemCategoriesResult.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Response;

use Dots\Data\DTO;

class SearchItemCategoriesResult extends DTO
{
    /** @var array<mixed> raw category ids as returned by the service */
    protected array $categoryIds = [];

    protected ?string $respondedProvider = null;

    /**
     * @return string[] category ids, ascending
     */
    public function getCategoryIds(): array
    {
        $categoryIds = [];
        foreach ($this->categoryIds as $categoryId) {
            if (! is_string($categoryId)) {
                continue;
            }

            $categoryIds[] = $categoryId;
        }

        return $categoryIds;
    }

    public function getRespondedProvider(): ?string
    {
        return $this->respondedProvider;
    }
}
