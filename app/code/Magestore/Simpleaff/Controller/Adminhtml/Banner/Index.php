<?php

namespace Magestore\Simpleaff\Controller\Adminhtml\Banner;

abstract class Index  extends \Magento\Backend\App\Action
{
	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
	
    /**
     * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\Registry $coreRegistry     
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }
   /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function executeInternal()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Magestore_Simpleaff::menus');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Banner'));
        $this->_addBreadcrumb(__('Simple'), __('Simple'));
        $this->_addBreadcrumb(__('Affilicate'), __('Affilicate'));
        $this->_addBreadcrumb(__('Banner'), __('Banner'));

        $this->_view->renderLayout();
    }
	/**
     * Check Permissions for all actions
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Simpleaff::manage_banner');
    }
}
