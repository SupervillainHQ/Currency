<?php
/**
 *
 */

namespace supervillainhq\currency {
	class Currency{
		private static $source = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

		protected $code; // ISO 4217 Currency Code
		private $rates;

		/**
		 * @return mixed
		 */
		public function getCode(){
			return $this->code;
		}

		private function setCode($code){
			$this->code = $code;
		}


		public function rates(){
			return $this->rates;
		}

		public function getRate($index){
		}

		public function hasRate(array $item){
		}

		public function addRate(array $item){
		}

		public function removeRate(array $item){
		}

		public function removeRateAt($index){
		}

		public function resetRates(array $array = []){
			$this->rates = $array;
		}


		static function get($code){}

		static function loadRatesFrom($source = null){
			if(is_null($source)){
				$source = self::$source;
			}
			$data = self::fetch($source);
			$rates = self::parseEcbXml($data);
			return $rates;
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
		}

	}
}


