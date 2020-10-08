<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Multistock_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * a constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('stock_grid');
        $this->setDefaultSort('main_table.stock_id');
        $this->setDefaultDir('ASC');
    }

    /**
     * Get the current product.
     *
     * @return Mage_Catalog_Model_Product
     */
    protected function getProduct()
    {
        return Mage::registry('current_product');
    }

    /**
     * Prepare the collection.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        /* @var $collection Rugento_Multistock_Model_Resource_Stock_Collection */
        $collection = Mage::getModel('Rugento_Multistock_Model_Resource_Stock_Collection');
        $collection
            ->excludeDefaultStock()
            ->joinStockItemsForProduct($this->getProduct())
            ->excludeDisableStock()
        ;
        $this->setCollection($collection);
        $this->setFilterVisibility(false);
        $this->setPagerVisibility(false);
        return parent::_prepareCollection();
    }

    /**
     * Prepare the columns.
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('stock_id', array(
            'header'            => $this->__('Stock ID'),
            'index'             => 'stock_id',
            'column_css_class'  => 'id',
            'width'             => '60px',
            'sortable'          => false
        ));

        $this->addColumn('stock_name', array(
            'header'    => $this->__('Stock Name'),
            'index'     => 'stock_name',
            'sortable'  => false
        ));

        $this->addColumn('qty', array(
            'header'            => $this->__('Qty'),
            'type'              => 'number',
            'validate_class'    => 'validate-number',
            'index'             => 'qty',
            'column_css_class'  => 'qty',
            'field_name'         => 'qty',
            'editable'          => true,
            'sortable'          => false
        ));

        $this->addColumn('is_in_stock', array(
            'header'            => $this->__('Is In Stock'),
            'type'              => 'checkbox',
            'column_css_class'  => 'is_in_stock',
            'index'             => 'is_in_stock',
            'field_name'        => 'is_in_stock',
            'value'             => '1',
            'align'             => 'center',
            'use_index'         => true,
            'sortable'          => false,
            'editable'          => true,
            'sortable'          => false
        ));

        return parent::_prepareColumns();
    }
}