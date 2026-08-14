<?php

/**
 * Description of SearchApiException.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Exceptions;

use RuntimeException;

class SearchApiException extends RuntimeException
{
    public function __construct(
        private readonly array $errors,
        string $message = '',
        private readonly int $httpStatus = 0,
    ) {
        parent::__construct($message);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }
}
