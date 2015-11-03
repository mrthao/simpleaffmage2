<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportXml extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal {
	public function execute() {
		$fileName = 'dailydeals.xml';
		$content = $this->_view->getLayout()->createBlock('Magestore\Dailydeal\Block\Adminhtml\Dailydeal\Grid')->getXml();
		return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
