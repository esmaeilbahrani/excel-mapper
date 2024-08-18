<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

namespace ExcelMapper\Interfaces;

interface ColumnParserInterface
{
    public function parse(mixed $value): mixed;
}