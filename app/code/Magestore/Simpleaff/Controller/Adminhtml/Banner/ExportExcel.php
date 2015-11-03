<?php
/**
 * @Author: zerokool - Nguyen Huu Tien
 * @Email: tien.uet.qh2011@gmail.com
 * @File Name: ExportExcel.php
 * @File Path: /home/zero/public_html/magento2/1.0.0-beta_v1/app/code/Magestore/Bannerslider/Controller/Adminhtml/Banner/ExportExcel.php
 * @Date:   2015-04-08 22:03:51
 * @Last Modified by:   zero
 * @Last Modified time: 2015-07-28 10:57:02
 */
namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportExcel extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal {
	public function execute() {
		$fileName = 'dailydeals.xls';
		$content = $this->_view->getLayout()->createBlock('Magestore\Dailydeal\Block\Adminhtml\Dailydeal\Grid')->getExcel();
		return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
