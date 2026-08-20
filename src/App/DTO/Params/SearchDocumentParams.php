<?php

/**
 * Description of SearchDocumentParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

/**
 * One searchable document. `entityId` is the indexed entity's id (dish token,
 * company id, address id, category id — depending on `type`); text fields are
 * maps keyed by language code, e.g. ['ua' => 'Піца', 'en' => 'Pizza'].
 * `updatedTime` orders out-of-order ingest jobs on the service side — pass
 * the moment the entity changed.
 */
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
