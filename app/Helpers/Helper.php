<?php

if (!function_exists('getTextColorBasedOnBg')) {
    /**
     * Calculate the luminance of a color and return black or white for text.
     *
     * @param int $r Red component (0-255)
     * @param int $g Green component (0-255)
     * @param int $b Blue component (0-255)
     * @return string
     */
    function getTextColorBasedOnBg(int $r, int $g, int $b): string
    {
        $luminance = getLuminance($r, $g, $b);
        return $luminance > 0.5 ? '#000000' : '#FFFFFF'; // black text for light bg and white text for dark bg
    }

    /**
     * Calculate the luminance of a color.
     *
     * @param int $r Red component (0-255)
     * @param int $g Green component (0-255)
     * @param int $b Blue component (0-255)
     * @return float
     */
    function getLuminance(int $r, int $g, int $b): float
    {
        $a = array_map(function ($v) {
            $v /= 255;
            return $v <= 0.03928 ? $v / 12.92 : pow(($v + 0.055) / 1.055, 2.4);
        }, [$r, $g, $b]);
        return $a[0] * 0.2126 + $a[1] * 0.7152 + $a[2] * 0.0722;
    }
}
