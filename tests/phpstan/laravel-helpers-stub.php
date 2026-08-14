<?php

/**
 * Laravel helper signatures for PHPStan only — the SDK depends on
 * illuminate/support, but these helpers ship with illuminate/foundation,
 * which is present in every consuming application yet not in this package.
 * This file is never executed.
 */

function config(string $key, mixed $default = null): mixed
{
    return $default;
}

function config_path(string $path = ''): string
{
    return $path;
}
