<?php
namespace Magestore\Simpleaff\Model;

class Giftcode extends \Magento\Rule\Model\AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Magestore\Simpleaff\Model\Banner');
        $this->setIdFieldName('banner_id');
    }

	/**
     * Get rule condition combine model instance
     *
     * @return \Magento\SalesRule\Model\Rule\Condition\CombineFactory
     */
    public function getConditionsInstance()
    {
        return $this->_conditionsInstance->create();
    }

    /**
     * Get rule condition product combine model instance
     *
     * @return \Magento\SalesRule\Model\Rule\Condition\Product\CombineFactory
     */
    public function getActionsInstance()
    {
        return $this->_actionsInstance->create();
    }
	
}
