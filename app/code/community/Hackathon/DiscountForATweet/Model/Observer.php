<?php
/**
 * License: GNU General Public License
 *
 * Copyright (c) 2012 Magento Hackathon. All rights reserved.
 * Note: Original work copyright to respective authors
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   Hackathon
 * @package    Hackathon_DiscountForATweet
 * @subpackage Model
 * @copyright  Copyright (c) 2012 Magento Hackathon
 * @license	   http://www.gnu.org/licenses/gpl.html GPL, version 3
 * @version    0.1.0
 * @link       http://magento-hackathon.de
 * @since      File available since Release 0.1.0
 * @author     Hackathon Core Team <core@hackathon>
 */

/**
 * Implements observer functionality for module.
 *
 * @category   Hackathon
 * @package    Hackathon_DiscountForATweet
 * @subpackage Model
 * @copyright  Copyright (c) 2012 Magento Hackathon
 * @license    http://www.gnu.org/licenses/gpl.html GPL, version 3
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 * @author     Hackathon Core Team <core@hackathon>
 */

class Hackathon_DiscountForATweet_Model_Observer
{

	/**
	 * Event: salesrule_rule_condition_combine
	 *
	 * @param $observer
	 *
	 * @return
	 */
	function addConditionToSalesRule($observer)
	{
		$additional = $observer->getAdditional();
		$conditions = (array) $additional->getConditions();
		$conditions = array_merge_recursive($conditions, array(
			array('label'=>Mage::helper('hackathon_discountforatweet')->__('Tweeted about'), 'value'=>'hackathon_discountforatweet/condition_tweet'),
		));
		$additional->setConditions($conditions);
		$observer->setAdditional($additional);
		return $observer;
	}
}