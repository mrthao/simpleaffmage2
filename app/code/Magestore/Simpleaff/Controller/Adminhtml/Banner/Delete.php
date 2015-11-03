<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

class Delete extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal
{
    public function execute()
    {
        $dailydealId = $this->getRequest()->getParam('entity_id');
        try {
            $locator = $this->_dailydealFactory->create()->load($dailydealId);
            $locator->delete();
            $this->messageManager->addSuccess(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }
}
