<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */


namespace ExcelMapper\DataProcessor;

use ExcelMapper\Interfaces\DataProcessorInterface;
use ExcelMapper\Parsers\DefaultParser;

class ExcelDataProcessor implements DataProcessorInterface
{
    public function process(array $sheetData, array $mapping, callable $rowCallback = null): void
    {
        foreach ($sheetData as $index => $row) {
            // Skip the header row by default
            if ($index === 0) {
                continue;
            }

            $mappedData = $this->mapColumns($row, $mapping);

            if ($rowCallback) {
                call_user_func($rowCallback, $mappedData);
            }
        }
    }

    private function mapColumns(array $row, array $mapping): array
    {
        $mappedData = [];

        foreach ($mapping as $excelColumn => [$dbField, $parserClass]) {
            $parserClass = $parserClass ?? DefaultParser::class;

            $parserInstance = new $parserClass();
            $value = $row[$excelColumn] ?? null;
            $mappedData[$dbField] = $parserInstance->parse($value);
        }

        return $mappedData;
    }
}