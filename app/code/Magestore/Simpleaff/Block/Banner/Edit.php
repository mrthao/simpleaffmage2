<?php
namespace Magestore\Bigbabies\Block\Adminhtml\Giftcard;
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
	    $this->_objectId = 'giftcode_id';
        $this->_blockGroup = 'Magestore_Bigbabies';
        $this->_controller = 'adminhtml_giftcard';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Gift Code'));
        $this->buttonList->update('delete', 'label', __('Delete Gift Code'));
        $this->buttonList->add(
            'email_giftcard',
            array(
                'label' => __('Send Gift To Customer'),
                'class' => 'save',
                'onclick' => 'setLocation(\'' . $this->getSendEmailUrl() . '\')'
            ),
            -100
        );
		*/
    }
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('bigbabies_giftcode')->getId()) {
            return __("Edit Gift Code '%1'", $this->escapeHtml($this->_coreRegistry->registry('bigbabies_giftcode')->getTitle()));
        } else {
            return __('New Gift Code');
        }
    }
	public function getSendEmailUrl()
    {
        return $this->getUrl('*/*/email',array('gift_code'=>$this->getRequest()->getParam('code_id')));
    }
}
