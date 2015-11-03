<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

class MassDelete extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $dailydealIds = $this->getRequest()->getParam('dailydeal');
        if (!is_array($dailydealIds) || empty($dailydealIds)) {
            $this->messageManager->addError(__('Please select dailydeal(s).'));
        } else {
            try {
                foreach ($dailydealIds as $dailydealId) {
                    $dailydeal = $this->_dailydealFactory->create()->load($dailydealId);
                    $dailydeal->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($dailydealIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}
