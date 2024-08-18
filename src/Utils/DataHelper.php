<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

namespace ExcelMapper\Utils;

class DataHelper
{
    public static function convertDigits(array|string $input): array|string
    {
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        if (is_array($input)) {
            return array_map([self::class, 'convertDigits'], $input);
        }

        return str_replace($persianDigits, $englishDigits, $input);
    }
}