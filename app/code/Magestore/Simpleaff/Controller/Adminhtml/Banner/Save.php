<?php
namespace Magestore\Bigbabies\Controller\Adminhtml\Giftcard;
use Magento\Framework\App\Filesystem\DirectoryList;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
	public function execute()
    {
        $data = $this->getRequest()->getPost();
        if ($data) {
            $model = $this->_objectManager->create('Magestore\Bigbabies\Model\Giftcard\Code');
			$id = $this->getRequest()->getParam('code_id');
            if ($id) {
                $model->load($id);
            }
            $model->setTitle($data['title']);	
			$model->setGiftcode($data['giftcode']);	
			$model->setAmount($data['amount']);	
			$model->setStatus($data['status']);	
			if ($id) {
				$model->setUpdateTime(time());
            }else{
				$model->setCreatedTime(time());
			}
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Gift Card Code has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('code_id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/index');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the gift code.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('code_id' => $this->getRequest()->getParam('code_id')));
            return;
        }
        $this->_redirect('*/*/index');
    }
}
