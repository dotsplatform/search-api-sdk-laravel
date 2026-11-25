<?php

/**
 * Description of SearchItemCategoriesQueryParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

class SearchItemCategoriesQueryParams extends DTO
{
    protected string $q;

    protected ?string $provider = null;

    /** @var string[]|null */
    protected ?array $langs = null;

    /** @var int[]|null */
    protected ?array $statuses = null;

    protected ?string $source = null;

    protected ?string $userId = null;

    public function getQ(): string
    {
        return $this->q;
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        return array_filter($data, fn ($value) => $value !== null && $value !== []);
    }
}
