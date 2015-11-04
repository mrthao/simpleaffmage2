<?php
namespace Magestore\Bigbabies\Controller\Adminhtml\Giftcard;

class NewAction extends \Magento\Backend\App\Action
{
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Bigbabies::save');
    }
    public function execute()
    {
        return $this->_forward('edit');
    }
}
