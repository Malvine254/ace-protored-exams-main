<?php

if (!function_exists('kebabCase')) {
    function kebabCase($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);

        $string = preg_replace_callback(
            '/([a-z])([A-Z])/',
            function ($matches) {
                return strtolower($matches[1]) . '-' . strtolower($matches[2]);
            },
            $string,
        );

        $string = str_replace(' ', '-', $string);

        $string = trim($string, '-');

        return $string;
    }
}
if (!function_exists('truncateString')) {
    function truncateString($string, $length, $ellipsis = '...')
    {
        // If the string is shorter than or equal to the specified length, return it as is
        if (strlen($string) <= $length) {
            return $string;
        }

        // Find the last space within the allowed length
        $truncated = substr($string, 0, $length);
        $lastSpace = strrpos($truncated, ' ');

        // If there's a space, truncate at the last space; otherwise, truncate at length
        if ($lastSpace !== false) {
            $truncated = substr($truncated, 0, $lastSpace);
        }

        // Add the ellipsis and return
        return $truncated . $ellipsis;
    }
}
