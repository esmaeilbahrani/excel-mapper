<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

namespace ExcelMapper\Interfaces;

interface DataProcessorInterface
{
    public function process(array $sheetData, array $mapping, callable $rowCallback = null): void;
}