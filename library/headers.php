<?php

class Headers
{
    public static function has(string $key)
    {
        return isset(getallheaders()[$key]);
    }

    public static function get($key, $fallback = "")
    {
        return getallheaders()[$key];
    }
}
