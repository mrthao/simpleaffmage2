<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magestore\Bigbabies\Controller\Adminhtml\Giftcard;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class ExportProductExcel extends \Magento\Reports\Controller\Adminhtml\Report\Shopcart
{
    /**
     * Export products report to Excel XML format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $fileName = 'shopcart_product.xml';
        $content = $this->_view->getLayout()->createBlock(
            'Magestore\Bigbabies\Block\Adminhtml\Giftcard\Grid'
        )->getExcelFile(
            $fileName
        );

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
