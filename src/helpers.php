<?php

if (!function_exists('filterInt')) {
    /**
     * @param string $str
     * @return int
     */
    function filterInt(string $str): int
    {
        return filter_var($str, FILTER_SANITIZE_NUMBER_INT);
    }
}

if (!function_exists('arrEach')) {
    /**
     * @param callable $callback
     * @param array    $arr
     */
    function arrEach(callable $callback, array $arr): void
    {
        foreach ($arr as $key => $item) {
            $callback($item, $key);
        }
    }
}

if (!function_exists('arrMap')) {
    /**
     * @param callable $callback
     * @param array    $arr
     * @return array
     */
    function arrMap(callable $callback, array $arr): array
    {
        $newArray = [];

        foreach ($arr as $key => $item) {
            $newArray[$key] = $callback($item, $key);
        }

        return $newArray;
    }
}

if (!function_exists('callIfKeyExists')) {
    /**
     * @param callable $callback
     * @param string   $key
     * @param array    $arr
     */
    function callIfKeyExists(callable $callback, string $key, array $arr)
    {
        if (array_key_exists($key, $arr)) {
            $callback();
        }
    }
}