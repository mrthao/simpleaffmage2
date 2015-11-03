<?php
/**
 * @Author: zerokool - Nguyen Huu Tien
 * @Email: tien.uet.qh2011@gmail.com
 * @File Name: ExportCsv.php
 * @File Path: /home/zero/public_html/magento2/1.0.0-beta_v1/app/code/Magestore/Bannerslider/Controller/Adminhtml/Banner/ExportCsv.php
 * @Date:   2015-04-08 15:29:01
 * @Last Modified by:   zero
 * @Last Modified time: 2015-07-28 10:56:59
 */

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportCsv extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal {
	public function execute() {
		$fileName = 'dailydeals.csv';
		$content = $this->_view->getLayout()->createBlock('Magestore\Dailydeal\Block\Adminhtml\Dailydeal\Grid')->getCsv();
		return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
