<?php
/**
 * PhpStorm.
 *
 * TODO: Documentation required!
 */

namespace supervillainhq\currency;

class CurrencyTest extends \PHPUnit_Framework_TestCase{

	function testParse(){
		$xml = file_get_contents(__DIR__ . '/../../../../resources/testrates.xml');
		$rates = Currency::parseEcbXml($xml);
		$this->assertNotEmpty($rates);
	}
}
