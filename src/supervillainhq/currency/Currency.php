<?php
/**
 *
 */

namespace supervillainhq\currency {
	final class Currency{
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

	}
}


