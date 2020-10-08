<?php

/**
 * @author RUGENTO
 *
 */
class Rugento_Multistock_Model_Stock_Item extends Mage_CatalogInventory_Model_Stock_Item
{

    /* (non-PHPdoc)
     * @see Mage_CatalogInventory_Model_Stock_Item::getStockId()
     */
    public function getStockId()
    {
        if (!$this->hasData('stock_id')) {
            $this->setData('stock_id', Mage::helper('multistock')->getCurrentWebsiteStock());
        }
        return $this->getData('stock_id');
    }
}