<?php

/**
 * Description of FoundSearchItem.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\DTO\Response;

use Dots\Data\DTO;

class FoundSearchItem extends DTO
{
    protected string $id = '';

    protected ?float $score = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }
}
