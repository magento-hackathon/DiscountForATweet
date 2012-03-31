<?php




class Hackathon_DiscountForATweet_Block_Tweetapp extends Hackathon_DiscountForATweet_Block_Abstract
{
	protected $twitterObj;
	
	
	public function _construct()
	{

		
	}
	
	
	public function buildTweetButton()
	{

	}
	
	
	public function isAuthenticated()
	{
		$customer = Mage::getSingleton('customer/session');
		return $customer->getIsReadyForTweet();
	}
	
	
	public function getFormActionUrl() 
	{
		return $this->getUrl('discountforatweet/index/post');
	}
	
}
	