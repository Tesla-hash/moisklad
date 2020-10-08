<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Model_Stock extends Mage_CatalogInventory_Model_Stock
{

    /**
     * (non-PHPdoc)
     * @see Mage_CatalogInventory_Model_Stock::getId()
     */
    public function getId()
    {
        if (!$this->hasData('stock_id')) {
            $this->setData('stock_id', Mage::helper('multistock')->getCurrentWebsiteStock());
        }
        return $this->getData('stock_id');
    }

    /**
     *
     * @return mixed
     */
    public function getStockName()
    {
        return $this->getData('stock_name');
    }

    /*
     * (non-PHPdoc)
     * @see Mage_Core_Model_Abstract::delete()
     */
    public function delete()
    {
        if ((int) $this->getId() == self::DEFAULT_STOCK_ID) {
            throw new Exception('Default Stock can not be removed!');
        } else {
            parent::delete();
        }
        return $this;
    }
}