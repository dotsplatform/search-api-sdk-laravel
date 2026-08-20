<?php

/**
 * Description of SearchDocumentType.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Entities;

abstract class SearchDocumentType
{
    public const COMPANY = 'company';

    public const ADDRESS = 'address';

    public const CATEGORY = 'category';

    public const ITEM = 'item';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::COMPANY,
            self::ADDRESS,
            self::CATEGORY,
            self::ITEM,
        ];
    }
}
