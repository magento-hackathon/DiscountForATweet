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
 * @subpackage Helper
 * @copyright  Copyright (c) 2012 Magento Hackathon
 * @license	   http://www.gnu.org/licenses/gpl.html GPL, version 3
 * @version    0.1.0
 * @link       http://magento-hackathon.de
 * @since      File available since Release 0.1.0
 * @author     Hackathon Core Team <core@hackathon>
 */

/**
 * Implements helper functionality. Provides basic read-access to all
 * the module's config options through the abstract config helper.
 *
 * @category   Hackathon
 * @package    Hackathon_DiscountForATweet
 * @subpackage Helper
 * @copyright  Copyright (c) 2012 Magento Hackathon
 * @license    http://www.gnu.org/licenses/gpl.html GPL, version 3
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 * @author     Hackathon Core Team <core@hackathon>
 */

class Hackathon_DiscountForATweet_Helper_Config
	extends Mage_Core_Helper_Abstract
{

	/**
	 * Holds the xml path to the config value
	 * hackathon/discountforatweet/general/enable
	 *
	 * @var string
	 */
	const XML_PATH_GENERAL_ENABLE = 'hackathon/discountforatweet/general/enable';
	
	/**
	 * Returns the configured value for the config value
	 * hackathon/discountforatweet/general/enable
	 *
	 * @param void
	 * @return mixed
	 */
	public function getGeneralEnable($storeId = null) {
		$config = Mage::getStoreConfig(
			self::XML_PATH_GENERAL_ENABLE, $storeId
		);
		
		return $config;
	}
}