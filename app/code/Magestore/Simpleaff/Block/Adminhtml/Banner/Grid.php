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
	protected $_collectionFactory;
	protected $_banner;
	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magestore\Simpleaff\Model\Banner $bannerAff,
        \Magento\Cms\Model\ResourceModel\PageFactory $bannerFactory,
        \Magestore\Simpleaff\Model\ResourceModel\Banner\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_bannerFactory = $bannerFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_banner = $bannerAff;
        parent::__construct($context, $backendHelper, $data);
    }
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerAffGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('DESC');
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    protected function _prepareCollection()
    {
		$collection = $this->_collectionFactory->create();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn('banner_id', ['header' => __('#ID'), 'index' => 'banner_id']);
        $this->addColumn('image', ['header' => __('Image'), 'index' => 'image']);
        $this->addColumn('title', ['header' => __('Title'), 'index' => 'title']);
        $this->addColumn('url', ['header' => __('Url'), 'index' => 'url']);
		$this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => $this->_banner->getStatuses()
            ]
        );
		$this->addExportType('*/*/exportCsv', __('CSV'));
		$this->addExportType('*/*/exportXml', __('XML'));
		$this->addExportType('*/*/exportExcel', __('Excel'));
        return parent::_prepareColumns();
    }
	/**
	 * @return $this
	 */
	protected function _prepareMassaction() {
		$this->setMassactionIdField('mass_banner');
		$this->getMassactionBlock()->setFormFieldName('banners');

		$this->getMassactionBlock()->addItem(
			'delete',
			[
				'label' => __('Delete'),
				'url' => $this->getUrl('simpleaff/banner/massDelete'),
				'confirm' => __('Are you sure?'),
			]
		);

		$statuses = $this->_banner->getStatuses();

		array_unshift($statuses, ['label' => '', 'value' => '']);
		$this->getMassactionBlock()->addItem(
			'status',
			[
				'label' => __('Change status'),
				'url' => $this->getUrl('simpleaff/banner/massStatus', ['_current' => true]),
				'additional' => [
					'visibility' => [
						'name' => 'status',
						'type' => 'select',
						'class' => 'required-entry',
						'label' => __('Status'),
						'values' => $statuses,
					],
				],
			]
		);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGridUrl() {
		return $this->getUrl('*/*/grid', array('_current' => true));
	}
    /**
     * After load collection
     *
     * @return void
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    /**
     * Filter store condition
     *
     * @param \Magento\Framework\Data\Collection $collection
     * @param \Magento\Framework\DataObject $column
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _filterStoreCondition($collection, \Magento\Framework\DataObject $column)
    {
        if (!($value = $column->getFilter()->getValue())) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }

    /**
     * Row click url
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['banner_id' => $row->getId()]);
    }
}
