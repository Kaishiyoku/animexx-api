<?php

if (!function_exists('filterInt')) {
    /**
     * @param string|null $str
     * @return int
     */
    function filterInt($str)
    {
        preg_match("/-?[0-9]+/", $str, $matches);

        if (count($matches) == 0) {
            return null;
        }

        return $matches[0];
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

if (!function_exists('arrFirst')) {
    /**
     * @param array $arr
     * @return mixed
     */
    function arrFirst(array $arr)
    {
        return count($arr) > 0 ? $arr[0] : null;
    }
}

if (!function_exists('callIfKeyExists')) {
    /**
     * @param callable $callback
     * @param string   $path
     * @param array    $arr
     */
    function callIfKeyExists(callable $callback, string $path, array $arr)
    {
        if (arrGet($path, $arr)) {
            $callback();
        }
    }
}

if (!function_exists('arrGet')) {
    /**
     * @param string $key
     * @param array  $arr
     * @return mixed|null
     */
    function arrGet(string $key, array $arr)
    {
        $keyArr = explode('.', $key);

        $firstKey = array_shift($keyArr);

        if (count($keyArr) == 0 && array_key_exists($firstKey, $arr)) {
            return $arr[$firstKey];
        }

        if (!is_array($arr) && count($keyArr) > 0) {
            return null;
        }

        if (array_key_exists($firstKey, $arr)) {
            return arrGet(implode('.', $keyArr), $arr[$firstKey]);
        }
    }
}