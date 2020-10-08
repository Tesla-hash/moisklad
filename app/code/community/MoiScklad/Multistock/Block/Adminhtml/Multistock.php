<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Multistock extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     */
    public function __construct()
    {
        $this->_blockGroup = 'multistock';
        $this->_controller = 'adminhtml_multistock';
        $this->_headerText = $this->__('Stock Qty');
        parent::__construct();
        $this->removeButton('add');
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Grid_Container::getHeaderCssClass()
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-products';
    }
}