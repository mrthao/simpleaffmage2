<?php
namespace Magestore\Simpleaff\Block\Adminhtml\Banner\Edit\Tab;
class Form extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
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
		$model = $this->_coreRegistry->registry('banner_register');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Banner Information')));

        if ($model->getId()) {
			$isElementDisabled = true;
            $fieldset->addField('banner_id', 'hidden', array('name' => 'banner_id'));
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
		if($model->getId()){
			$fieldset->addField(
				'image',
				'text',
				array(
					'name' => 'image',
					'label' => __('Image Path'),
					'title' => __('Image Path'),
					'required' => true,
					'disabled' => true,
				)
			);
		}else{
			$fieldset->addField(
				\Magento\ImportExport\Model\Import::FIELD_NAME_SOURCE_FILE,
				'file',
				[
					'name' => 'image',
					'label' => __('Select File to Import'),
					'title' => __('Select File to Import'),
					'required' => true,
					'class' => 'input-file'
				]
			);
		}
		$fieldset->addField(
            'url',
            'text',
            array(
                'name' => 'url',
                'label' => __('Url'),
                'title' => __('Url'),
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
        return __('Banner Information');
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