<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magestore\Bigbabies\Controller\Adminhtml\Giftcard;

class MassDelete extends \Magento\Backend\App\Action
{
 
   
    public function execute()
    {
        $giftcode_ids = $this->getRequest()->getParam('giftcodeids');
        if (!is_array($giftcode_ids) || empty($giftcode_ids)) {
            $this->messageManager->addError(__('Please select giftcode(s).'));
        } else {
            try {
                foreach ($giftcode_ids as $giftcode_id) {
                    $giftcode = $this->_objectManager->get('Magestore\Bigbabies\Model\Giftcard\Code')->load($giftcode_id);
                    $giftcode->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($giftcode_ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*');
    }
}
