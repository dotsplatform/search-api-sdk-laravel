<?php

/**
 * Description of SearchDocumentsQueryParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

class SearchDocumentsQueryParams extends DTO
{
    protected string $q;

    protected ?string $provider = null;

    /** @var string[]|null */
    protected ?array $types = null;

    protected ?string $cityId = null;

    protected ?string $companyId = null;

    /** @var string[]|null */
    protected ?array $langs = null;

    /** @var int[]|null */
    protected ?array $statuses = null;

    protected ?string $categoryId = null;

    protected ?string $sortField = null;

    protected ?string $sortDirection = null;

    protected ?int $limit = null;

    protected ?int $offset = null;

    protected ?string $source = null;

    protected ?string $userId = null;

    public function getQ(): string
    {
        return $this->q;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        return array_filter($data, fn ($value) => $value !== null && $value !== []);
    }
}
