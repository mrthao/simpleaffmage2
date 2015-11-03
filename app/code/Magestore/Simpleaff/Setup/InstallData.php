<?php

namespace Magestore\Simpleaff\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
	protected $_eavSetupFactory;
	
	public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory){
		$this->_eavSetupFactory = $eavSetupFactory;
	}

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
		/**
		 *  Add adtribute is_deal
		 */ 
		$eavSetup->removeAttribute(
            'catalog_product',
            'is_deal'
		);
		 
		$data = array(
            'group' => 'General',
            'type' => 'varchar',
            'input' => 'select',
            'default' => 1,
            'label' => 'Is Deal',
            'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
            'frontend' => '',
            'source' => 'Magestore\Dailydeal\Model\Isdealselect',
            'visible' => 1,
            'required' => 1,
            'user_defined' => 1,
            'used_for_price_rules' => 1,
            'position' => 2,
            'unique' => 0,
            'default' => '',
            'sort_order' => 100,
            'apply_to' => 'dailydeal',
            'is_global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
            'is_required' => 1,
            'is_configurable' => 1,
            'is_searchable' => 0,
            'is_visible_in_advanced_search' => 0,
            'is_comparable' => 0,
            'is_filterable' => 0,
            'is_filterable_in_search' => 1,
            'is_used_for_promo_rules' => 1,
            'is_html_allowed_on_front' => 0,
            'is_visible_on_front' => 0,
            'used_in_product_listing' => 1,
            'used_for_sort_by' => 0,
        );
        $eavSetup->addAttribute(
            'catalog_product',
            'is_deal',
            $data);
		
		/**
		 *  Add adtribute is_deal
		 */
    }
}
