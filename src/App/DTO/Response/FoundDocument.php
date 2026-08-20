<?php

/**
 * Description of FoundDocument.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Response;

use Dots\Data\DTO;

class FoundDocument extends DTO
{
    protected string $id = '';

    protected string $type = '';

    protected ?float $score = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }
}
