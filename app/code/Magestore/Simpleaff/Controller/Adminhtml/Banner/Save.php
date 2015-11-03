<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal {
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	public function execute() {

		if ($data = $this->getRequest()->getPostValue()) {
			$model = $this->_dailydealFactory->create();

			if ($id = $this->getRequest()->getParam('entity_id')) {
				$model->load($id);
			}

			$model->setData($data);
			var_dump($data);
			
			try {
				$model->save();

				$this->messageManager->addSuccess(__('The dailydeal has been saved.'));
				$this->_getSession()->setFormData(false);
				

				if ($this->getRequest()->getParam('back') === 'edit') {
					$this->_redirect(
						'*/*/edit',
						[
							'entity_id' => $model->getId(),
							'_current' => true,
						]
					);

					return;
				} elseif ($this->getRequest()->getParam('back') === "new") {
					$this->_redirect('*/*/new', array('_current' => true));
					return;
				}
				
				$this->_redirect('*/*/');
				return;
			} catch (\Magento\Framework\Model\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\RuntimeException $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
				$this->messageManager->addException($e, __('Something went wrong while saving the dailydeal.'));
			}

			$this->_getSession()->setFormData($data);
			$this->_redirect('*/*/edit', array('entity_id' => $this->getRequest()->getParam('entity_id')));
			return;
		}
		$this->_redirect('*/*/');
	}
}
