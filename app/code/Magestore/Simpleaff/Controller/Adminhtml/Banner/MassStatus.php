<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

class MassStatus extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal {
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	public function execute() {
		$dailydealIds = $this->getRequest()->getParam('dailydeal');
		$status = $this->getRequest()->getParam('status');
		$storeViewId = $this->getRequest()->getParam('store');
		// die;
		if (!is_array($dailydealIds) || empty($dailydealIds)) {
			$this->messageManager->addError(__('Please select dailydeal(s).'));
		} else {
			try {
				foreach ($dailydealIds as $dailydealId) {
					$dailydeal = $this->_dailydealFactory->create()->setStoreViewId($storeViewId)->load($dailydealId);
					$dailydeal->setStatus($status)
						->setIsMassupdate(true)
						->save();
				}
				$this->messageManager->addSuccess(
					__('A total of %1 record(s) have been changed status.', count($dailydealIds))
				);
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/', ['store' => $this->getRequest()->getParam("store")]);
	}
}
