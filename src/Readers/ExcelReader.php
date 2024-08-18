<?php
/**
 * @author   Esmaeil Bahrani Fard
 * @link https://github.com/esmaeilbahrani
 * @license  https://opensource.org/licenses/MIT MIT License
 */

namespace ExcelMapper\Readers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use ExcelMapper\Interfaces\ExcelReaderInterface;

class ExcelReader implements ExcelReaderInterface
{
    public function read(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);
        return $spreadsheet->getActiveSheet()->toArray();
    }
}
