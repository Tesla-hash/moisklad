<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Stock_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('stock_tabs');
        $this->setDestElementId('edit_form');
    }
}