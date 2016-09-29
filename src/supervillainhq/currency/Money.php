<?php
/**
 * PhpStorm.
 *
 * Easy Money
 */

namespace supervillainhq\currency {
	class Money{
		protected $currency;
		protected $amount;

		/**
		 * @return Currency
		 */
		public function getCurrency(){
			return $this->currency;
		}

		/**
		 * Change the currency without any conversion calculations on the internal amount.
		 *
		 * @param Currency $currency
		 */
		public function setCurrency(Currency $currency){
			$this->currency = $currency;
		}

		/**
		 * @return mixed
		 */
		public function getAmount(){
			return $this->amount;
		}

		/**
		 * @param mixed $amount
		 */
		public function setAmount($amount){
			$this->amount = $amount;
		}

		/**
		 * Convert the instance value into given Currency. This will initiate a conversion calculation and round the internal amount
		 *
		 * @param Currency $currency
		 * @return bool
		 */
		function convert(Currency $currency){
			$rate = $currency->getRate();
			return false;
		}

		function __toString(){
			// TODO: Implement __toString() method. Maybe require the i18n extension in order to output localised numbers?
			// Also consider customised formatting for local shorthands and quirky vernaculars (eg. danish tradition to
			// substitute an amount, having zero smallest unit with a dash, like so: 50,00 turning into 50,-
			if(!class_exists('\NumberFormatter')){
//				throw new \Exception('Missing php extension (i18n), Consider installing php-intl');
			}
			return "{$this->amount}";
		}
	}
}


