<?php

/**
 * Description of SearchItemsQueryParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

/**
 * Search query parameters. Everything except `q` is optional — omitted
 * values fall back to the service defaults (fields: name only, langScope:
 * all, layout correction and external-code matching on).
 */
class SearchItemsQueryParams extends DTO
{
    protected string $q;

    protected ?string $provider = null;

    /** @var string[]|null */
    protected ?array $fields = null;

    protected ?string $langScope = null;

    protected ?string $lang = null;

    protected ?bool $layoutCorrection = null;

    protected ?bool $matchExternalCodes = null;

    /** @var int[]|null */
    protected ?array $statuses = null;

    protected ?string $categoryId = null;

    protected ?string $sortField = null;

    protected ?string $sortDirection = null;

    protected ?int $limit = null;

    protected ?int $offset = null;

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
        $data = array_filter($data, fn ($value) => $value !== null && $value !== []);

        // Booleans travel in a query string — send them as 0/1 explicitly.
        foreach (['layoutCorrection', 'matchExternalCodes'] as $booleanKey) {
            if (array_key_exists($booleanKey, $data)) {
                $data[$booleanKey] = $data[$booleanKey] ? 1 : 0;
            }
        }

        return $data;
    }
}
