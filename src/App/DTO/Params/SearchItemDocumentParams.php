<?php

/**
 * Description of SearchItemDocumentParams.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Params;

use Dots\Data\DTO;

/**
 * One searchable item document. `id` is the item (dish) token; text fields
 * are maps keyed by language code, e.g. ['ua' => 'Піца', 'en' => 'Pizza'].
 */
class SearchItemDocumentParams extends DTO
{
    protected string $id;

    protected ?string $categoryId = null;

    protected ?string $externalId = null;

    protected ?string $ean = null;

    protected ?string $tradeMark = null;

    protected int $status = 0;

    protected bool $popular = false;

    protected int $priority = 0;

    protected int $price = 0;

    /** @var array<string, string> */
    protected array $names = [];

    /** @var array<string, string> */
    protected array $excerpts = [];

    /** @var array<string, string> */
    protected array $descriptions = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        return array_filter($data, fn ($value) => $value !== null);
    }
}
