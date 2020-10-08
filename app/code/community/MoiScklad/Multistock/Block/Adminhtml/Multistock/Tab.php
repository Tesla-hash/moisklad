<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Multistock_Tab extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Inventory implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('multistock/product/tab/inventory.phtml');
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::getTabLabel()
     */
    public function getTabLabel()
    {
        return $this->__('Inventory');
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::getTabTitle()
     */
    public function getTabTitle()
    {
        return $this->__('Inventory');
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::canShowTab()
     */
    public function canShowTab()
    {
        return $this->getProduct() ? true : false;
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::isHidden()
     */
    public function isHidden()
    {
        return ! $this->canShowTab();
    }

    /**
     * @return string
     */
    public function getAfter()
    {
        return 'websites';
    }

    /**
     * @return Ambigous <string, unknown>
     */
    public function getStockGrid()
    {
        return $this->getLayout()->createBlock('multistock/adminhtml_multistock')->toHtml();
    }
}