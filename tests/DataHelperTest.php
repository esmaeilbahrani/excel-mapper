<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

use PHPUnit\Framework\TestCase;
use ExcelMapper\Utils\DataHelper;

class DataHelperTest extends TestCase
{
    public function testConvertDigitsFromPersianToEnglish()
    {
        $persianNumber = '۱۲۳۴۵۶۷۸۹۰';
        $expectedEnglishNumber = '1234567890';

        $this->assertEquals($expectedEnglishNumber, DataHelper::convertDigits($persianNumber));
    }

    public function testConvertDigitsInArray()
    {
        $persianNumbers = ['۱۲۳', '۴۵۶', '۷۸۹۰'];
        $expectedEnglishNumbers = ['123', '456', '7890'];

        $this->assertEquals($expectedEnglishNumbers, DataHelper::convertDigits($persianNumbers));
    }

    public function testNoConversionNeeded()
    {
        $englishNumber = '1234567890';

        $this->assertEquals($englishNumber, DataHelper::convertDigits($englishNumber));
    }
}