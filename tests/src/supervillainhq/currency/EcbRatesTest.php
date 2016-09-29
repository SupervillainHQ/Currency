<?php
/**
 * PhpStorm.
 *
 * TODO: Documentation required!
 */

namespace supervillainhq\currency;

class EcbRatesTest extends \PHPUnit_Framework_TestCase{

	function testParse(){
		$xml = file_get_contents(__DIR__ . '/../../../../resources/testrates.xml');
		$rates = EcbRates::loadRatesFromXml($xml);
		$this->assertNotEmpty($rates);
	}
}
