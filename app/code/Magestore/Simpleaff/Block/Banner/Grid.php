<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magestore\Simpleaff\Block\Adminhtml\Banner;
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
	protected $_bannerFactory;
	protected $_banner;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magestore\Simpleaff\Model\BannerFactory $bannerFactory,
        \Magestore\Simpleaff\Model\Banner $banner,
        array $data = array()
    ) {
        $this->_bannerFactory = $bannerFactory;
        $this->_banner = $banner;
        parent::__construct($context, $backendHelper, $data);
    }
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {	
		
        $collection = $this->_giftcardFactory->create()->getCollection();		
            
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'code_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );
        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',                
            ]
        );
        $this->addColumn(
            'giftcode',
            [
                'header' => __('Giftcode'),
                'index' => 'giftcode',
                
            ]
        );
        $storeId = (int) $this->getRequest()->getParam('store_id',0);
        $store = $this->_storeManager->getStore($storeId);
        $this->addColumn(
            'amount',
            [
                'header' => __('Amount'),
                'index' => 'amount',
                'type' => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),
            ]
        );        
        $this->addColumn(
            'type',
            [
                'header' => __('Created At'),
                'index' => 'created_time',
                'type' => 'date',
               
            ]
        );
		$this->addColumn(
            'type',
            [
                'header' => __('Update At'),
                'index' => 'update_time',
                'type' => 'date',
               
            ]
        );
        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => array(2 => 'Disable',
                                   1 => 'Enable'),
            ]
        );
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit',                          
                        ],
                        'field' => 'code_id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,                
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );                
		$this->addExportType('*/*/exportProductCsv', __('CSV'));
        $this->addExportType('*/*/exportProductExcel', __('Excel XML'));
        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('gift_code');
        $this->getMassactionBlock()->setFormFieldName('giftcodeids');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => __('Delete'),
                'url' => $this->getUrl('bigbabiesadmin/giftcard/massDelete'),
                'confirm' => __('Are you sure?')
            )
        );

       $statuses = $this->_giftcard->getAvailableStatuses();

      array_unshift($statuses, array('label' => '', 'value' => ''));
      $this->getMassactionBlock()->addItem(
           'status',
            array(
                'label' => __('Change status'),
                'url' => $this->getUrl('bigbabiesadmin/giftcard/massStatus', array('_current' => true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    )
                )
            )
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('simpleaff/banner/grid', array('_current' => true));
    }
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'simpleaff/banner/edit',
            array('banner_id' => $row->getId())
        );
    }
}
