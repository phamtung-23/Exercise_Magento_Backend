<?php
namespace Training\Vendor\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup->startSetup();

            $table = $installer->getConnection()
            ->newTable($installer->getTable('training_vendor_entity'))
            ->addColumn('entity_id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],'Entity ID')
            ->addColumn( 'name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Name')
            ->setComment('Training Vendor Entity Table');
    
            $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
