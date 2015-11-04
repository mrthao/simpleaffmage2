<?php
namespace Magestore\Simpleaff\Block\Adminhtml\Banner;
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
	    $this->_objectId = 'banner_edit';
        $this->_blockGroup = 'Magestore_Simpleaff';
        $this->_controller = 'adminhtml_banner';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Banner'));
        $this->buttonList->update('delete', 'label', __('Delete Banner'));
    }
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('banner_register')->getId()) {
            return __("Edit Banner '%1'", $this->escapeHtml($this->_coreRegistry->registry('banner_register')->getTitle()));
        } else {
            return __('New Banner');
        }
    }
}
