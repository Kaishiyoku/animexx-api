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
     * @param array $arr
     */
    function arrEach(callable $callback, array $arr): void
    {
        foreach ($arr as $key => $item) {
            $callback($item, $key);
        }
    }
}