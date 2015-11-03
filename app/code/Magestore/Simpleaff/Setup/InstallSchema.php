<?php
namespace Magestore\Simpleaff\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Eav\Model\Entity\Type;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {
	/**
	 * {@inheritdoc}
	 */
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$installer = $setup;
		$installer->startSetup();

		$installer->getConnection()->dropTable($installer->getTable('dailydeal_deal'));
		
		$table = $installer->getConnection()->newTable(
			$installer->getTable('dailydeal_deal')
		)->addColumn(
			'entity_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			10,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Entity Id'
		)->addColumn(
			'product_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			10,
			['unsigned' => true, 'nullable' => false, 'default' => '0'],
			'Product Id'
		)->addColumn(
            'price',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['default' => '0'],
            'Price'
        )->addColumn(
			'deal_qty',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			10,
			['unsigned' => true, 'nullable' => false, 'default' => '0'],
			'Deal Qty'
		)->addColumn(
			'seal_qty',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			10,
			['unsigned' => true, 'nullable' => false, 'default' => '0'],
			'seal_qty'
		)->addColumn(
			'deal_start',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
			null,
			['nullable' => false],
			'Deal Start'
		)->addColumn(
			'deal_end',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
			null,
			['nullable' => false],
			'Deal End'
		)->addColumn(
			'store',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => false, 'default' => ''],
			'Store'
		)->addColumn(
			'status',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			['nullable' => false, 'default' => '1'],
			'Status'
		);
		$installer->getConnection()->createTable($table);
		/**
		 * End create table dailydeal_deal
		 */
		
		$installer->endSetup();

	}
}
