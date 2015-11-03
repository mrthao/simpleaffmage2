<?php
namespace Magestore\Bigbabies\Block\Adminhtml\Giftcard\Edit\Tab;
class Giftcode extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()


    {
		$model = $this->_coreRegistry->registry('bigbabies_giftcode');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Gift Code Information')));

        if ($model->getId()) {
            $fieldset->addField('code_id', 'hidden', array('name' => 'code_id'));
        }

        $fieldset->addField(
            'title',
            'text',
            array(
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
                'disabled' => $isElementDisabled,
            )
        );
		$fieldset->addField(
            'giftcode',
            'text',
            array(
                'name' => 'giftcode',
                'label' => __('Gift Code'),
                'title' => __('Title'),
                'required' => true,
                'disabled' => $isElementDisabled,
            )
        );
		$fieldset->addField(
            'amount',
            'text',
            array(
                'name' => 'amount',
                'label' => __('Amount'),
                'title' => __('Amount'),
                'required' => true,
                'disabled' => $isElementDisabled,
            )
        );
		
		$fieldset->addField(
            'status',
            'select',
            array(
                'label' => __('Status'),
                'title' => __('Page Status'),
                'name' => 'status',
                'required' => true,
                'options' => $model->getAvailableStatuses(),
                'disabled' => $isElementDisabled
            )
        );
		if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Form');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Gift Code Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}