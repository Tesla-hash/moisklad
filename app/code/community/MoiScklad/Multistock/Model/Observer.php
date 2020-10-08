<?php

/**
 * @author RUGENTO
 *
 */
class Rugento_Multistock_Model_Observer
{
    /**
     * @var unknown
     */
    protected $_rests = null;

    /**
     * @param Varien_Event_Observer $observer
     * @return Rugento_Multistock_Model_Observer
     */
    public function prepareCatalogProductIndexSelect(Varien_Event_Observer $observer)
    {
        $select = $observer->getEvent()->getSelect();
        /**
         * TODO change for multi website stock status
         * Сейчас статус переиндексируется только для основного склада
         * для остальных статус наличия по сайтам не переиндексируется
         */
//        $select->where('ciss.stock_id = ?', Mage_CatalogInventory_Model_Stock::DEFAULT_STOCK_ID);
        return $this;
    }

    /**
     * @param unknown $event
     */
    public function multiStock($event)
    {
        $restUid    = Mage::app()->getRequest()->getParam('stock_id', $event->getEvent()->getData('rest_uid'));
        $sourceData = $event->getEvent()->getData('source_data');
        $status     = $event->getEvent()->getData('status');
        $item       = $event->getEvent()->getItem();

        if(Mage::getStoreConfig('cml2/stock/multi') && $restUid !== null) {
            if($this->_rests === null) {
                $this->_rests = Mage::getModel('Rugento_Multistock_Model_Resource_Stock_Collection')->load();
            }
            $stock = $this->_rests->getItemByColumnValue('uid', $restUid);
            if($stock) {
                $sourceData->setData('stock_id', $stock->getData('stock_id'));

                if($stock->getStockType() == '3' && is_numeric($item->getSummary())) {
                    $sourceData->setData('qty', $item->getSummary());
                }

            } else {
                $status->save = false; //off save stock data
            }
        }
        return $this;
    }
}