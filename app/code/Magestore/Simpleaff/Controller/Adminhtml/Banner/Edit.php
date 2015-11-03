<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }


    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $model = $this->_objectManager->create('Magestore\Dailydeal\Model\Dailydeal');
        $registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError('Dailydeal is not exist.');
                $this->_redirect('*/*/');
                return;
            }
        }
        
        $data = $this->_objectManager->create('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        
        $registryObject->register('dailydeal_data', $model);
        $resultPage = $this->resultPageFactory->create();
        if ($model->getId()) {
            $resultPage->getConfig()->getTitle()->prepend($model->getDailydeal());
        } else {    
            $resultPage->getConfig()->getTitle()->prepend(__('New Dailydeal'));
        }
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Dailydeal::dailydeal');
    }
}
