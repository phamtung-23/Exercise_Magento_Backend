<?php

namespace Unit5\BannerRepository\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Function install
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup->startSetup();

        $table = $installer->getConnection()
        ->newTable($installer->getTable('banner_entity'))
        ->addColumn('entity_id', Table::TYPE_INTEGER, null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],'Entity ID')
        ->addColumn( 'linkimg', Table::TYPE_TEXT, 255, ['nullable' => false], 'link image')
        ->addColumn( 'des', Table::TYPE_TEXT, 255, ['nullable' => false], 'descript')
        ->setComment('Banner Entity Table');

        $installer->getConnection()->createTable($table);

    $installer->endSetup();
    }
}