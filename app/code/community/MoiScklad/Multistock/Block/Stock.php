<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Stock extends Mage_Core_Block_Template
{
    /**
     *
     */
    public function getStocksData()
    {
         /* @var $collection Rugento_Multistock_Model_Resource_Stock_Collection */
        $collection = Mage::getModel('Rugento_Multistock_Model_Resource_Stock_Collection');
        $collection
            ->joinStockItemsForProduct(Mage::helper('catalog')->getProduct())
            ->excludeDisableStock()
        ;
        return $collection;
    }
}