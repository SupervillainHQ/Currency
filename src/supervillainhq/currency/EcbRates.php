<?php
/**
 * No caching implemented - please code responsibly and don't hammer the ecb service!
 */

namespace supervillainhq\currency {
	class EcbRates{
		private static $source = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

		static function loadRatesFromXml($xml){
			return self::parseEcbXml($xml);
		}

		static function loadRates($source = null){
			if(is_null($source)){
				$source = self::$source;
			}
			$data = self::fetch($source);
			return self::parseEcbXml($data);
		}

		static private function fetch($uri){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $uri);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);

			$message = null;
            if($output === false){
            	$message = curl_error($ch);
            }

			curl_close($ch);

			if(!is_null($message)){
                throw new \Exception($message, 500);
			}
			return $output;
		}

		static private function parseEcbXml($data){
			$doc = new \DOMDocument();
			$doc->loadXML($data);
			$cubes = $doc->getElementsByTagName('Cube');
			$rates = [];
			foreach ($cubes as $cube){
				if($cube->hasAttribute('currency') && $cube->hasAttribute('rate')){
					$rates[$cube->getAttribute('currency')] = floatval($cube->getAttribute('rate'));
				}
			}
			return $rates;
		}
	}
}


