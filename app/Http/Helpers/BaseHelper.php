<?php
namespace App\Http\Helpers;

class BaseHelper{
    public static function IndexOf(string $needle, array $haystack): int
    {
        $lowerHaystack = array_map(function ($item) {
            return strtolower($item);
        }, $haystack);
        return array_search(strtolower($needle), $lowerHaystack);
    }
    public static function ValueOf($index, array $array): string
    {
        if (!in_array($index, array_keys($array)) && !array_key_exists($index, $array)) return '';
        return $array[$index];
    }
}
