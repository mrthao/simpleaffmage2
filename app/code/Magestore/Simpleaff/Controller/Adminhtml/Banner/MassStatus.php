<?php
namespace Magestore\Bigbabies\Controller\Adminhtml\Giftcard;
class MassStatus extends \Magento\Backend\App\Action
{   
    public function execute()
    {           
        $giftcard_ids = $this->getRequest()->getParam('giftcodeids');
		$status = $this->getRequest()->getParam('status');
        if (!is_array($giftcard_ids) || empty($giftcard_ids)) {
            $this->messageManager->addError(__('Please select giftcard(s).'));
        } else {
            try {
                foreach ($giftcard_ids as $giftcard_id) {
                    $giftcard = $this->_objectManager->get('Magestore\Bigbabies\Model\Giftcard\Code')->load($giftcard_id);
                    $giftcard->setData('status',$status)
                        ->save();				                    
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed status.', count($giftcard_ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
		 $this->_redirect('*/*/');
    }
}

