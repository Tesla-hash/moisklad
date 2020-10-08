<?php

/**
 * @author RUGENTO
 *
 */
class Rugento_Multistock_Model_Resource_Stock extends Mage_CatalogInventory_Model_Resource_Stock
{

    /* (non-PHPdoc)
     * @see Mage_CatalogInventory_Model_Resource_Stock::setInStockFilterToCollection()
     */
    public function setInStockFilterToCollection($collection)
    {
        $this->_initConfig();
        $manageStock = Mage::getStoreConfig(Mage_CatalogInventory_Model_Stock_Item::XML_PATH_MANAGE_STOCK);
        $cond = array('{{table}}.use_config_manage_stock = 0 AND {{table}}.manage_stock=1 AND {{table}}.is_in_stock=1',
                     '{{table}}.use_config_manage_stock = 0 AND {{table}}.manage_stock=0',);

        if ($manageStock) {
            $cond[] = '{{table}}.use_config_manage_stock = 1 AND {{table}}.is_in_stock=1';
        } else {
            $cond[] = '{{table}}.use_config_manage_stock = 1';
        }

        $collection->joinField(
            'inventory_in_stock', 'cataloginventory/stock_item', 'is_in_stock', 'product_id=entity_id', join(
                ' AND ', array('(' . join(') OR (', $cond) . ')',
                               $this->_getReadAdapter()->quoteInto('stock_id = ? ', $this->_stock->getId()))
            )
        );
        return $this;
    }

    /**
     * @param unknown $websiteId
     */
    public function getStockIdByWebsiteId($websiteId)
    {
        $connection = $this->_getReadAdapter();
        $select = $connection->select()->from($this->getTable('multistock/multistock'), array(
            'stock_id'
        ));
        $where = array(
            'website_id=?' => $websiteId,
            'status=?'     => '1', //on
            'stock_type<?' => '2', //without info
        );
        return $connection->fetchOne($select, $where);
    }

     /*
     * (non-PHPdoc)
     * @see Mage_Core_Model_Resource_Db_Abstract::_afterSave()
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $adapter = $this->_getWriteAdapter();
        $adapter->delete($this->getTable('multistock/multistock'), $adapter->quoteInto('stock_id' . '=?', $object->getData('stock_id')));
        $adapter->insert(
                $this->getTable('multistock/multistock'),
                    $object->unsFormKey()
                           ->unsStockName()
                           ->getData()
                )
        ;
        return $this;
    }

        /*
     * (non-PHPdoc)
     * @see Mage_Core_Model_Resource_Db_Abstract::_getLoadSelect()
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);
        $select->joinLeft(array(
            't_att' => $this->getTable('multistock/multistock')
        ), 't_att.stock_id='.$this->getTable('cataloginventory/stock').'.stock_id');
        return $select;
    }
}