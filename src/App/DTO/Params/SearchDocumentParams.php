<?php

/**
 * Description of SearchDocumentParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

class SearchDocumentParams extends DTO
{
    protected string $type;

    protected string $entityId;

    protected ?string $companyId = null;

    protected ?string $categoryId = null;

    protected ?string $cityId = null;

    protected ?string $externalId = null;

    protected ?string $ean = null;

    protected ?string $tradeMark = null;

    protected int $status = 0;

    protected int $priority = 0;

    protected ?int $updatedTime = null;

    /** @var array<string, string> */
    protected array $names = [];

    /** @var array<string, string> */
    protected array $excerpts = [];

    /** @var array<string, string> */
    protected array $descriptions = [];

    public function getType(): string
    {
        return $this->type;
    }

    public function getEntityId(): string
    {
        return $this->entityId;
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        return array_filter($data, fn ($value) => $value !== null);
    }
}
