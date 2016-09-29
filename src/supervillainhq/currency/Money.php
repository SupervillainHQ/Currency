<?php
/**
 * PhpStorm.
 *
 * TODO: Documentation required!
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
	}
}


