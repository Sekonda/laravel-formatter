<?php namespace Sekonda\Formatter\Test\Parsers;

use Sekonda\Formatter\Test\TestCase;
use Sekonda\Formatter\Parsers\Parser;
use Sekonda\Formatter\Parsers\YamlParser;
use Sekonda\Formatter\Parsers\XmlParser;

class YamlParserTest extends TestCase {

	public function testYamlParserIsInstanceOfParserInterface() {
		$parser = new YamlParser('');
		$this->assertTrue($parser instanceof Parser);
	}

	public function testtoArrayReturnsArrayRepresenationOfYamlObject() {
		$expected = ['foo' => 'bar'];
		$parser = new XmlParser('<xml><foo>bar</foo></xml>');
		$x = new YamlParser($parser->toYaml());
		$this->assertEquals($expected, $x->toArray());
	}

}
