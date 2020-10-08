<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Stock extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     */
    public function __construct()
    {
        $this->_blockGroup = 'multistock';
        $this->_controller = 'adminhtml_stock';
        $this->_headerText = $this->__('Manage Stock');
        parent::__construct();
    }
}