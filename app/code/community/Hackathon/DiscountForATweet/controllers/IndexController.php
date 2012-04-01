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
 * @category	 Hackathon
 * @package		Hackathon_DiscountForATweet
 * @subpackage Controller
 * @copyright	Copyright (c) 2012 Magento Hackathon
 * @license		 http://www.gnu.org/licenses/gpl.html GPL, version 3
 * @version		0.1.0
 * @link			 http://magento-hackathon.de
 * @since			File available since Release 0.1.0
 * @author		 Hackathon Core Team <core@hackathon>
 */

/**
 * Implements front controller actions
 *
 * @category	 Hackathon
 * @package		Hackathon_DiscountForATweet
 * @subpackage Controller
 * @copyright	Copyright (c) 2012 Magento Hackathon
 * @license		http://www.gnu.org/licenses/gpl.html GPL, version 3
 * @version		Release: 0.1.0
 * @since			Class available since Release 0.1.0
 * @author		 Hackathon Core Team <core@hackathon>
 */

require_once('Hackathon/DiscountForATweet/lib/EpiCurl.php');
require_once('Hackathon/DiscountForATweet/lib/EpiOAuth.php');
require_once('Hackathon/DiscountForATweet/lib/EpiTwitter.php');
require_once('Hackathon/DiscountForATweet/lib/secret.php');

class Hackathon_DiscountForATweet_IndexController extends Mage_Core_Controller_Front_Action {

	public function preDispatch() {
		parent::preDispatch();
		$consumer_key = 'N960N886lxxT0GCg74rmUg';
		$consumer_secret = '5R1DroadOWQ5gDltla5HWWEldDkdM5eB2MJdWqqpAfo';

		$this->twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$this->customer = $this->_getCustomer();

		if ($this->getRequest()->getParam('oauth_token', false)) {

			$this->twitterObj->setToken($this->getRequest()->getParam('oauth_token', false));

			$token = $this->twitterObj->getAccessToken();
			$this->twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

			$this->customer->setTwitterAuthToken($token->oauth_token);
			$this->customer->setTwitterAuthTokenSecret($token->oauth_token_secret);

			$twitterInfo = $this->twitterObj->get_accountVerify_credentials();

			$this->customer->setTwitterUsername($twitterInfo->screen_name);

			// check if we really have access
			if ($twitterInfo->screen_name) {
				$this->customer->setIsReadyForTweet(true);
			}
		}

		return $this;
	}

	/**
	 * Standard action for rendering layout.
	 *
	 * @return void
	 */
	public function indexAction() {
		$link = 'twitter sign in: <a href="' . $this->twitterObj->getAuthorizationUrl() . '">sign in!</a>';

		$customer = $this->_getCustomer();

		$this->loadLayout();
		$this->getLayout()->getBlock('tweetapp')->assign('status', 'status')->assign('link', $link)
				->assign('username', $customer->getTwitterUsername());

		$this->renderLayout();

	}

	public function postAction() {
		if ($this->getRequest()->isPost() && $this->getRequest()->getPost('comment')) {

			$this->twitterObj->setToken($this->customer->getTwitterAuthToken(), $this->customer->getTwitterAuthTokenSecret());

			$update_status = $this->twitterObj->post_statusesUpdate(array(
																																	 'status' => $this->getRequest()->getPost('comment')
																															));
			$response = $update_status->response;

			$message = $response['text'];
			$messages = $this->customer->getTwitterMessages();

			if (!is_array($messages)) {
				$messages = array();
			}

			$messages[] = $message;
			$session = Mage::getSingleton('customer/session');
			$session->setTwitterMessages($messages);

		}
	}

	/**
	 * applying a discount code from the twitter ajax callback
	 */
	public function applyAction() {

	}

	public function _getCustomer() {
		return Mage::getSingleton('customer/session');
	}

}