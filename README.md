# ExcelMapper

ExcelMapper is a powerful and flexible PHP library designed to streamline the process of mapping, parsing, and importing data from Excel files into your applications. Whether you're dealing with simple spreadsheets or complex data structures, ExcelMapper provides an intuitive interface for transforming Excel data into a format that's easy to work with in your PHP projects.

## Features

- **Customizable Column Mappings**: Define how each column in your Excel file should be processed using custom or default parsers.
- **Seamless Integration**: Easily integrate with your existing PHP applications and workflows.
- **Powered by PHPSpreadsheet**: Leverages the robust capabilities of PHPSpreadsheet to handle Excel files.
- **Extensible Architecture**: Extend and customize the library to suit your specific needs.

## Installation

You can install ExcelMapper via Composer. Run the following command:

```bash
composer require esmaeil/excel-mapper
```

## Usage

#### Basic Example
Here’s how to use ExcelMapper to read an Excel file, process the data, and handle it with a custom callback:

```php
use ExcelMapper\DataProcessor\ExcelDataProcessor;
use ExcelMapper\Readers\ExcelReader;
use ExcelMapper\Parsers\DefaultParser;

// Define custom column mapping
$mapping = [
    ['first_name', DefaultParser::class],
    ['last_name', DefaultParser::class],
    [phone_number', DefaultParser::class],
];

// Read Excel file
$reader = new ExcelReader();
$sheetData = $reader->read('path_to_file.xlsx');

// Process the data
$processor = new ExcelDataProcessor();
$processor->process($sheetData, $mapping, function($mappedData) {
    // Handle the mapped data (e.g., save to database)
    print_r($mappedData);
});
```

### Custom Parsers
If you need custom processing logic for specific columns, you can create your own parser by implementing the ColumnParserInterface.
```php
use ExcelMapper\Interfaces\ColumnParserInterface;

class UppercaseParser implements ColumnParserInterface
{
    public function parse(mixed $value): mixed
    {
        return strtoupper($value);
    }
}
```
Then you can then use this custom parser in your column mappings:
```php
$mapping = [
    [first_name', UppercaseParser::class],
    ['last_name', UppercaseParser::class],
];
```

### Advanced Usage
You can extend ExcelMapper further by integrating additional functionality or modifying the existing ones:

* Creating Custom Readers: Implement your own reader by following the ExcelReaderInterface.
* Extending Processors: Customize how data is processed by extending the ExcelDataProcessor.

### Testing
To run tests, make sure you have PHPUnit installed. You can run the tests using the following command:

```bash
vendor/bin/phpunit
```

### Contributing
We welcome contributions! If you have ideas to improve this project or have found bugs, please open an issue or submit a pull request.

### License
ExcelMapper is licensed under the MIT License. See the LICENSE file for more details.

### Contact
For any inquiries or support, feel free to reach out at esmaeil94@gmail.com.