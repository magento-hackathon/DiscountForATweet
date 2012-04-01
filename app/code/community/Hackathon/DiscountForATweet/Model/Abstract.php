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
 * Implements abstract model functionality for module.
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

abstract class Hackathon_DiscountForATweet_Model_Abstract
	extends Mage_Core_Model_Abstract
{
	/**
	 * Holds an instance of the module's
	 * global config helper
	 *
	 * @var Hackathon_DiscountForATweet_Helper_Config
	 */
	protected $_config;
	
	/**
	 * Creates and returns an instance of the module's
	 * global config helper
	 *
	 * @param void
	 * @return Hackathon_DiscountForATweet_Helper_Config
	 */
	public function getConfig() {
		if(!$this->_config) {
			$this->_config = Mage::helper('discountforatweet/config');
		}
	
		return $this->_config;
	}
}