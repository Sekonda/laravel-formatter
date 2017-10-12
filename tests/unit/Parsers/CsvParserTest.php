<?php namespace Sekonda\Formatter\Test\Parsers;

use Sekonda\Formatter\Test\TestCase;
use Sekonda\Formatter\Parsers\Parser;
use Sekonda\Formatter\Parsers\CsvParser;

class CsvParserTest extends TestCase {

	private $simpleCsv = 'foo,boo
bar,far';

	public function testCsvParserIsInstanceOfParserInterface() {
		$parser = new CsvParser('');
		$this->assertTrue($parser instanceof Parser);
	}

    /**
     * @expectedException InvalidArgumentException
     */
	public function testConstructorThrowsInvalidExecptionWhenArrayDataIsProvided() {
		$parser = new CsvParser([0, 1, 3]);
	}

	public function testtoArrayReturnsCsvArrayRepresentation() {
		$expected = [['foo' => 'bar', 'boo' => 'far']];
		$parser = new CsvParser($this->simpleCsv);
		$this->assertEquals($expected, $parser->toArray());
	}

	public function testtoJsonReturnsJsonRepresentationOfNamedArray() {
		$expected = '[{"foo":"bar","boo":"far"}]';
		$parser = new CsvParser($this->simpleCsv);
		$this->assertEquals($expected, $parser->toJson());
	}

}
