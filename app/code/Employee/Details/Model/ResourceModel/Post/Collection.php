<?php
namespace Employee\Details\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id_column';
	protected $_eventPrefix = 'mp_post_collection';
	protected $_eventObject = 'id_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Employee\Details\Model\Post', 'Employee\Details\Model\ResourceModel\Post');
	}

}
