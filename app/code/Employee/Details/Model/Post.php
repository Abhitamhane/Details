<?php
namespace Employee\Details\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'mp_post';

	protected $_cacheTag = 'mp_post';

	protected $_eventPrefix = 'mp_post';

	protected function _construct()
	{
		$this->_init('Employee\Details\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	/*public function getDefaultValues()
	{
		$values = [];

		return $values;
	}*/
}