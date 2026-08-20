<?php

/**
 * Description of SearchRequestSource.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Entities;

abstract class SearchRequestSource
{
    public const ADMIN = 'admin';

    public const WEB = 'web';

    public const IOS = 'ios';

    public const ANDROID = 'android';

    public const API = 'api';

    public const OTHER = 'other';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::ADMIN,
            self::WEB,
            self::IOS,
            self::ANDROID,
            self::API,
            self::OTHER,
        ];
    }
}
