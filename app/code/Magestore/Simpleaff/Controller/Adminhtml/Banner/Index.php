<?php

namespace Magestore\Simpleaff\Controller\Adminhtml\Banner;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory

class Index extends Action implements AccountInterface
{

   /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }
        $this->_view->loadLayout();

        /**
         * Set active menu item
         */
        $this->_setActiveMenu('Magestore_Simpleaff::menus');

        /**
         * Add breadcrumb item
         */
        $this->_addBreadcrumb(__('Simple Affilicate'), __('Banner'));
        $this->_addBreadcrumb(__('Simple Affilicate'), __('Manage Banner'));

        $this->_view->renderLayout();
    }
}
