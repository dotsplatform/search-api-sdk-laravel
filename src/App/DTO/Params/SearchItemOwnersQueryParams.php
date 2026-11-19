<?php

/**
 * Description of SearchItemOwnersQueryParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

class SearchItemOwnersQueryParams extends DTO
{
    protected string $q;

    protected ?string $cityId = null;

    /** @var string[]|null */
    protected ?array $langs = null;

    /** @var int[]|null */
    protected ?array $statuses = null;

    protected ?string $provider = null;

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
