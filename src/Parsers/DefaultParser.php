<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

namespace ExcelMapper\Parsers;

use ExcelMapper\Interfaces\ColumnParserInterface;
use ExcelMapper\Utils\DataHelper;

class DefaultParser implements ColumnParserInterface
{
    public function parse(mixed $value): string|array
    {
        // Convert Persian/Arabic digits to English digits
        $value = DataHelper::convertDigits($value);

        return $value;
    }
}