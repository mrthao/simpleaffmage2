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

		/*--------------------------------------------------------------------------*/
		$installer->getConnection()->dropTable($installer->getTable('simpleaffiliate_banner'));
		$table = $installer->getConnection()->newTable(
			$installer->getTable('simpleaffiliate_banner')
		)->addColumn(
			'banner_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Banner Id'
		)->addColumn(
			'title',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => false, 'default' => ''],
			'Title'
		)->addColumn(
            'image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false,'default' => ''],
            'Image Path'
        )->addColumn(
			'url',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => false, 'default' => ''],
			'Url'
		)->addColumn(
			'status',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			2,
			['nullable' => false, 'default' => '1'],
			'Status'
		);
		$installer->getConnection()->createTable($table);
		/*--------------------------------------------------------------------------*/
		$installer->getConnection()->dropTable($installer->getTable('simpleaffiliate_account'));
		$table2 = $installer->getConnection()->newTable(
			$installer->getTable('simpleaffiliate_account')
		)->addColumn(
			'account_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Acount Id'
		)->addColumn(
			'customer_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			['unsigned' => true, 'nullable' => false],
			'Customer ID'
		)->addColumn(
            'fristname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false,'default' => ''],
            'First Name'
        )->addColumn(
			'lastname',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => false, 'default' => ''],
			'Last Name'
		)->addColumn(
			'email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => false, 'default' => ''],
			'Email'
		)->addColumn(
			'balance',
			\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
			'12,4',
			['nullable' => false],
			'Balance'
		)->addColumn(
			'total_received',
			\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
			'12,4',
			['nullable' => false],
			'Total Received'
		)->addColumn(
			'joined',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATE,
			'',
			['nullable' => false],
			'Joined'
		)->addColumn(
			'status',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			2,
			['nullable' => false, 'default' => '1'],
			'Status'
		);
		$installer->getConnection()->createTable($table2);
		/*--------------------------------------------------------------------------*/
		$installer->getConnection()->dropTable($installer->getTable('simpleaffiliate_transaction'));
		$table3 = $installer->getConnection()->newTable(
			$installer->getTable('simpleaffiliate_transaction')
		)->addColumn(
			'transaction_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Transaction Id'
		)->addColumn(
			'order_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			['unsigned' => true, 'nullable' => false],
			'Order ID'
		)->addColumn(
            'affiliate_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
            ['nullable' => false],
            'Affiliate Id'
        )->addColumn(
			'order_total',
			\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
			'12,4',
			['nullable' => false, 'default' => 0],
			'Order Total'
		)->addColumn(
			'commission',
			\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
			255,
			['nullable' => false, 'default' => 0],
			'Commission'
		)->addColumn(
			'store',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			['nullable' => false],
			'Store'
		)->addColumn(
			'created',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
			null,
			['nullable' => false],
			'Created'
		)->addColumn(
			'status',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			2,
			['nullable' => false, 'default' => '1'],
			'Status'
		);
		$installer->getConnection()->createTable($table3);
		$installer->endSetup();	
	}
}
