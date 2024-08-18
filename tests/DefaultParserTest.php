<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

use PHPUnit\Framework\TestCase;
use ExcelMapper\Parsers\DefaultParser;

class DefaultParserTest extends TestCase
{
    public function testParseWithPersianDigits()
    {
        $parser = new DefaultParser();
        $persianNumber = '۱۲۳۴۵۶۷۸۹۰';
        $expectedEnglishNumber = '1234567890';

        $this->assertEquals($expectedEnglishNumber, $parser->parse($persianNumber));
    }

    public function testParseWithEnglishDigits()
    {
        $parser = new DefaultParser();
        $englishNumber = '1234567890';

        $this->assertEquals($englishNumber, $parser->parse($englishNumber));
    }

    public function testParseWithNonNumericString()
    {
        $parser = new DefaultParser();
        $string = 'Hello World!';

        $this->assertEquals($string, $parser->parse($string));
    }
}