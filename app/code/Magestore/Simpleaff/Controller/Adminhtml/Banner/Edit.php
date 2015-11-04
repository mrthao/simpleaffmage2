<?php
namespace Magestore\Bigbabies\Controller\Adminhtml\Giftcard;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action
{
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Bigbabies::save');
    }
	public function execute()
    {
		// 1. Get ID and create model
        $id = $this->getRequest()->getParam('code_id');
        $model = $this->_objectManager->create('Magestore\Bigbabies\Model\Giftcard\Code');
		$registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This gift code no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
		$registryObject->register('bigbabies_giftcode', $model);
		
		$this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
