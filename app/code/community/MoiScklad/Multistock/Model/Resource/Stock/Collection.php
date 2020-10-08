<?php

/**
 * @author RUGENTO
 *
 */
class Rugento_Multistock_Model_Resource_Stock_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    /* (non-PHPdoc)
     * @see Mage_Core_Model_Resource_Db_Collection_Abstract::_construct()
     */
    protected function _construct()
    {
        $this->_init('cataloginventory/stock');
    }

     /*
     * (non-PHPdoc)
     * @see Mage_Core_Model_Resource_Db_Collection_Abstract::_initSelect()
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(array(
            't_multi' => $this->getTable('multistock/multistock')
        ), 'main_table.stock_id=t_multi.stock_id')
        ;
    }

    /**
     */
    public function excludeDefaultStock()
    {
        $this->addFieldToFilter('main_table.stock_id', array(
            'gt' => 1
        ));
        return $this;
    }

    /**
     */
    public function excludeDisableStock()
    {
        $this->addFieldToFilter('t_multi.status', array(
            'eq' => 1
        ));
        return $this;
    }

    /**
     * @param unknown $product
     * @return Rugento_Multistock_Model_Resource_Stock_Collection
     */
    public function joinStockItemsForProduct($product)
    {
        $this->getSelect()->joinLeft(
            array('stock_item_table' => $this->getTable('cataloginventory/stock_item')), implode(
                ' AND ',
                array('main_table.stock_id=stock_item_table.stock_id', $this->getConnection()->quoteInto(
                    'stock_item_table.product_id=?', $product->getId()
                ))
            ), array('item_id'     => 'item_id', 'qty' => 'IF (qty IS NULL,0,qty)',
                     'is_in_stock' => 'IF (is_in_stock IS NULL,0,is_in_stock)',
                     'empty'       => 'IF (qty IS NULL,true,false)')
        );
        return $this;
    }

    /* (non-PHPdoc)
     * @see Varien_Data_Collection::getNewEmptyItem()
     */
    public function getNewEmptyItem()
    {
        return new Rugento_Multistock_Model_Stock();
    }
}