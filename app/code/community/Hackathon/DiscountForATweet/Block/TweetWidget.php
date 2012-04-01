<?php
/**
 * Widget to show Twitter-Button
 *
 * @method getTemplatefield - Templatefile (magic)
 * @method setSalesRule - setSalesrule (magic)
 */
class Hackathon_DiscountForATweet_Block_TweetWidget 
	extends Hackathon_DiscountForATweet_Block_Abstract
	implements Mage_Widget_Block_Interface
{

	/**
	 * set the Templatefile
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * check wether a salesrule is set, if it is the case change it to html
	 *
	 * @return string
	 */
	protected function _toHtml() {
		$this->setTemplate($this->getTemplatefield());
		if (!($this->getSalesRule() instanceof Mage_SalesRule_Model_Rule)) {
			return '';
		}
		return parent::_toHtml();
	}

	/**
	 * get the salesrule
	 *
	 * if the salesrule is not set, it is created from the configuration
	 *
	 * @return Mage_Core_Model_Abstract
	 * @throws InvalidArgumentException
	 */
	public function getSalesRule() {
		// if it is set, we got the object
		if ($salesrule = parent::getSalesRule()) {
			return $salesrule;
		}

		// if not we have to get it!
		$salesruleId = $this->getData('salesRule');
		if (!is_numeric($salesruleId)) {
			throw new InvalidArgumentException('Salesrule have to be an id!');
		}

		$salesrule = Mage::getModel('salesrule/rule')->load($salesruleId);
		// check wether something was loaded
		if ($salesruleId != $salesrule->getId()) {
			throw new InvalidArgumentException('Salesrule doesn\'t exist!');
		}

		// set the rule
		$this->setSalesRule($salesrule);
		return $salesrule;
	}
}