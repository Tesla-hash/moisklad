<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Helper_Data extends Mage_Core_Helper_Data
{

    /**
     * @var unknown
     */
    const CURRENT_STOCK = 'current_stock';

    /**
     * @return mixed
     */
    public function getCurrentStock()
    {
        return Mage::registry(self::CURRENT_STOCK);
    }

    /**
     * @param Mage_CatalogInventory_Model_Stock $stock
     */
    public function setCurrentStock(Mage_CatalogInventory_Model_Stock $stock)
    {
        Mage::register(self::CURRENT_STOCK, $stock);
        return $stock;
    }

    /**
     *
     */
    public function getCurrentWebsiteStock()
    {
        $websiteId = Mage::app()->getWebsite()->getId();
        $stockId   = Mage::getResourceModel('multistock/stock')->getStockIdByWebsiteId($websiteId);
        if(strlen($stockId) > 0) {
            return $stockId;
        }
        return Mage_CatalogInventory_Model_Stock::DEFAULT_STOCK_ID;
    }
}