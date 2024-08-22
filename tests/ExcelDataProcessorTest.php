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

    public function testExcelColumnToIndex()
    {
        $processor = new ExcelDataProcessor();

        $this->assertEquals(0, $processor->excelColumnToIndex('A'));
        $this->assertEquals(1, $processor->excelColumnToIndex('B'));
        $this->assertEquals(25, $processor->excelColumnToIndex('Z'));
        $this->assertEquals(26, $processor->excelColumnToIndex('AA'));
        $this->assertEquals(27, $processor->excelColumnToIndex('AB'));
        $this->assertEquals(51, $processor->excelColumnToIndex('AZ'));
        $this->assertEquals(701, $processor->excelColumnToIndex('ZZ'));
        $this->assertEquals(702, $processor->excelColumnToIndex('AAA'));
    }

    public function testProcessWithColumnMapping()
    {
        $processor = new ExcelDataProcessor();

        $sheetData = [
            ['First Name', 'Last Name', 'Phone Number'],  // Header: A | B | C
            ['John', 'Doe', '۰۹۱۲۳۴۵۶۷۸۹'],  // Data row
        ];

        $mapping = [
            'A' => 'first_name',
            'B' => 'last_name',
            'C' => ['phone_number', DefaultParser::class],
        ];

        $processedData = [];
        $processor->process($sheetData, $mapping, function ($mappedData) use (&$processedData) {
            $processedData[] = $mappedData;
        });

        $expectedData = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '09123456789',  // Persian digits should be converted
            ]
        ];

        $this->assertEquals($expectedData, $processedData);
    }
    public function testProcessSkipsHeaderRow()
    {
        $processor = new ExcelDataProcessor();

        $sheetData = [
            ['First Name', 'Last Name', 'Phone Number'],  // Header
            ['John', 'Doe', '۰۹۱۲۳۴۵۶۷۸۹'],  // Data row
        ];

        $mapping = [
            'A' => 'first_name',
            'B' => 'last_name',
            'C' => ['phone_number', DefaultParser::class],
        ];

        $processedData = [];
        $processor->process($sheetData, $mapping, function ($mappedData) use (&$processedData) {
            $processedData[] = $mappedData;
        });

        $expectedData = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '09123456789',  // Persian digits should be converted
            ]
        ];

        $this->assertEquals($expectedData, $processedData);
    }

}