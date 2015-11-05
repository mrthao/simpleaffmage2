<?php
namespace Magestore\Simpleaff\Controller\Adminhtml\Banner;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action
{
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Simpleaff::save');
    }
	public function execute()
    {
        $id = $this->getRequest()->getParam('banner_id');
        $model = $this->_objectManager->create('Magestore\Simpleaff\Model\Banner');
		$registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This banner no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
		$registryObject->register('simpleaff_banner_register', $model);
		
		$this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
