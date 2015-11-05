<?php
namespace Magestore\Simpleaff\Controller\Adminhtml\Banner;

class NewAction extends \Magento\Backend\App\Action
{
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Simpleaff::save');
    }
    public function execute()
    {
        return $this->_forward('edit');
    }
}
