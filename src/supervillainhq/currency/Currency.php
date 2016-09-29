<?php
/**
 *
 */

namespace supervillainhq\currency {
	final class Currency{
		private static $source = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
		private static $rates;

		private $code; // ISO 4217 Currency Code
		private $rate;

		/**
		 * @return mixed
		 */
		public function getCode(){
			return $this->code;
		}

		private function setCode($code){
			$this->code = $code;
		}

		public function getRate(){
			return $this->rate;
		}

		private function setRate($rate){
			$this->rate = $rate;
		}

		/**
		 * Currency constructor.
		 * @param $code
		 * @param float $rate
		 */
		final private function __construct($code, $rate = 1.0) {
			$this->setCode($code);
			$this->setRate($rate);
		}


		static function get($code, $rate = null){
			if(is_null($rate) && is_array(self::$rates)){
				$rate = self::$rates[$code];
			}
			$instance = new Currency($code, $rate);
			return $instance;
		}

		static function loadRatesFrom($source = null){
			if(is_null($source)){
				$source = self::$source;
			}
			$data = self::fetch($source);
			self::$rates = self::parseEcbXml($data);
			return self::$rates;
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

		static function parseEcbXml($data){
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


