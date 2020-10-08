<?php
$installer = $this;
$installer->startSetup();

if (! $installer->getConnection()->isTableExists($installer->getTable('multistock/multistock'))) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('multistock/multistock'))
        ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true
    ), 'ID')
        ->addColumn('uid', Varien_Db_Ddl_Table::TYPE_TEXT, 128, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true
    ), 'ID Exchange')
        ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 5, array(
        'unsigned' => true,
        'nullable' => true,
        'primary' => true
    ), 'Website Id')
        ->addColumn('stock_code', Varien_Db_Ddl_Table::TYPE_TEXT, 32, array(
        'nullable' => false
    ), 'Stock Code')
        ->addColumn('stock_type', Varien_Db_Ddl_Table::TYPE_TEXT, 32, array(
        'nullable' => false
    ), 'Stock Type')
        ->addColumn('stock_country', Varien_Db_Ddl_Table::TYPE_TEXT, 128, array(
        'nullable' => false
    ), 'Country')
        ->addColumn('stock_city', Varien_Db_Ddl_Table::TYPE_TEXT, 128, array(
        'nullable' => false
    ), 'City')
        ->addColumn('stock_postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 12, array(
        'nullable' => false
    ), 'Postcode')
        ->addColumn('stock_address', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false
    ), 'Address')
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
        'unsigned' => true
    ), 'Status')
        ->addColumn('latitude', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        'nullable' => false
    ), 'Latitude')
        ->addColumn('longitude', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        'nullable' => false
    ), 'Longitude')
        ->addIndex($installer->getIdxName('multistock/multistock', array(
        'stock_id'
    )), array(
        'stock_id'
    ))
        ->addIndex($installer->getIdxName('multistock/multistock', array(
        'uid'
    )), array(
        'uid'
    ), array(
        'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ))
    ->addIndex($installer->getIdxName('multistock/multistock', array(
        'website_id'
    )), array(
        'website_id'
    ))
        ->addIndex($installer->getIdxName('multistock/multistock', array(
        'stock_code'
    )), array(
        'stock_code'
    ), array(
        'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ))
        ->addForeignKey($installer->getFkName('multistock/multistock', 'stock_id', 'cataloginventory/stock', 'stock_id'), 'stock_id', $installer->getTable('cataloginventory/stock'), 'stock_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
//        ->addForeignKey($installer->getFkName('multistock/multistock', 'website_id', 'core/website', 'website_id'), 'website_id', $installer->getTable('core/website'), 'website_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);
        ;
    $installer->getConnection()->createTable($table);

    $installer->getConnection()->insert($installer->getTable('multistock/multistock'), [
        'stock_id'               => '1',
        'uid'                    => '0000',
        'website_id'             => '0'
    ]);
}


$installer->endSetup();