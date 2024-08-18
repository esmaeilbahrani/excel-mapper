<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

use PHPUnit\Framework\TestCase;
use ExcelMapper\DataProcessor\ExcelDataProcessor;
use ExcelMapper\Parsers\DefaultParser;

class ExcelDataProcessorTest extends TestCase
{
    public function testProcessWithSimpleMapping()
    {
        $processor = new ExcelDataProcessor();

        $sheetData = [
            ['First Name', 'Last Name', 'Phone Number'],  // Header
            ['John', 'Doe', '۱۲۳۴۵۶۷۸۹۰'],  // Data row
        ];

        $mapping = [
            ['first_name', DefaultParser::class],
            ['last_name', DefaultParser::class],
            ['phone_number', DefaultParser::class],
        ];

        $processedData = [];
        $processor->process($sheetData, $mapping, function ($mappedData) use (&$processedData) {
            $processedData[] = $mappedData;
        });

        $expectedData = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '1234567890',  // Persian digits should be converted
            ]
        ];

        $this->assertEquals($expectedData, $processedData);
    }

    public function testProcessSkipsHeaderRow()
    {
        $processor = new ExcelDataProcessor();

        $sheetData = [
            ['First Name', 'Last Name'],  // Header
            ['John', 'Doe'],  // Data row
        ];

        $mapping = [
            ['first_name', DefaultParser::class],
            ['last_name', DefaultParser::class],
        ];

        $processedData = [];
        $processor->process($sheetData, $mapping, function ($mappedData) use (&$processedData) {
            $processedData[] = $mappedData;
        });

        $expectedData = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]
        ];

        $this->assertEquals($expectedData, $processedData);
    }
}