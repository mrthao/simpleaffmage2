<?php

namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

class Grid extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}
