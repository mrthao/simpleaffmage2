<?php
namespace Magestore\Bigbabies\Block\Adminhtml\Giftcard\Edit;
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('giftcode_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Gift Code Information'));
    }
}
