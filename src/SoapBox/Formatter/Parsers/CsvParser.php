<?php namespace Sekonda\Formatter\Parsers;

use InvalidArgumentException;
use League\Csv\Reader;
use Sekonda\Formatter\ArrayHelpers;

class CsvParser extends Parser
{

    private $csv;

    public function __construct($data)
    {
        if (is_string($data)) {
            $this->csv = Reader::createFromString($data);
        } else {
            throw new InvalidArgumentException(
                'CsvParser only accepts (string) [csv] for $data.'
            );
        }
    }

    public function toArray()
    {
        $temp = $this->csv->jsonSerialize();

        $headings = $temp[0];
        $result = $headings;

        if (count($temp) > 1) {
            $result = [];
            for ($i = 1; $i < count($temp); ++$i) {
                $row = [];
                for ($j = 0; $j < count($headings); ++$j) {
                    if (!empty($temp[$i][$j])) {
                        $row[$headings[$j]] = $temp[$i][$j];
                    } else {
                        $row[$headings[$j]] = null;
                    }
                }
                $expanded = [];
                foreach ($row as $key => $value) {
                    ArrayHelpers::set($expanded, $key, $value);
                }
                $result[] = $expanded;
            }
        }

        return $result;
    }
}

