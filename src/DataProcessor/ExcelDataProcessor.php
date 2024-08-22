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

        foreach ($mapping as $excelColumn => $dbFieldConfig) {
            if (is_string($dbFieldConfig)) {
                $dbField = $dbFieldConfig;
                $parserClass = DefaultParser::class;
            } elseif (is_array($dbFieldConfig) && count($dbFieldConfig) === 2) {
                [$dbField, $parserClass] = $dbFieldConfig;
            } else {
                throw new \InvalidArgumentException("Invalid mapping configuration for column $excelColumn");
            }

            $parserInstance = new $parserClass();
            $value = $row[$this->excelColumnToIndex($excelColumn)] ?? null;
            $mappedData[$dbField] = $parserInstance->parse($value);
        }

        return $mappedData;
    }

    public function excelColumnToIndex(string $column): int
    {
        $column = strtoupper($column);
        $length = strlen($column);
        $index = 0;

        for ($i = 0; $i < $length; $i++) {
            $index = $index * 26 + ord($column[$i]) - ord('A') + 1;
        }

        return $index - 1; // Convert 1-based index to 0-based index
    }
}