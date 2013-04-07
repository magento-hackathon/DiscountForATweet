<?php

class Hackathon_DiscountForATweet_Model_Condition_Tweet extends Mage_Rule_Model_Condition_Abstract {

	/**
	 * @TODO for whatever this it, check it and afterwards document it!
	 *
	 * @return Hackathon_DiscountForATweet_Model_Condition_Tweet
	 */
	public function loadAttributeOptions() {
		$attributes = array(
			'tweetContent' => Mage::helper('discountforatweet')->__('Tweet content')
		);

		$this->setAttributeOption($attributes);

		return $this;
	}

	/**
	 * @TODO for whatever this it, check it and afterwards document it!
	 *
	 * @return mixed
	 */
	public function getAttributeElement() {
		$element = parent::getAttributeElement();
		$element->setShowAsText(true);
		return $element;
	}

	/**
	 * @TODO for whatever this it, check it and afterwards document it!
	 *
	 * @return string
	 */
	public function getInputType() {

		switch ($this->getAttribute()) {
			case 'tweetContent':
				return 'select';
		}
		return 'string';
	}

	/**
	 * @TODO for whatever this it, check it and afterwards document it!
	 * @return string
	 */
	public function getValueElementType() {
		return 'text';
	}

	/**
	 * Validate Tweet Rule Condition
	 *
	 * @param Varien_Object $object
	 *
	 * @return bool
	 */
	public function validate(Varien_Object $object) {
		$session = Mage::getSingleton('customer/session');
		$messages = $session->getTwitterMessages();
		if (is_array($messages)) {
			foreach ($messages as $m) {
				if ($this->validateAttribute($m)) {
					return true;
				}
			}
		}
		return false;
	}
}