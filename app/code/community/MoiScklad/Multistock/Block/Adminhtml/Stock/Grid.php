<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Stock_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('stock_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('asc');
    }

    /*
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Grid::_prepareCollection()
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('Rugento_Multistock_Model_Resource_Stock_Collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /*
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Grid::_prepareColumns()
     */
    protected function _prepareColumns()
    {
        $this->addColumn('stock_id', array(
            'header' => $this->__('Stock Id'),
            'align'  => 'left',
            'index'  => 'stock_id',
            'width'  => '50px'
        ));

        $this->addColumn('stock_name', array(
            'header' => $this->__('Name'),
            'align'  => 'left',
            'index'  => 'stock_name'
        ));

         $this->addColumn('stock_type', array(
            'header'  => $this->__('Stock Type'),
            'align'   => 'left',
            'index'   => 'stock_type',
            'type'    => 'options',
            'options' => Mage::getModel('Rugento_Multistock_Model_Source_Type')->toArray(),
        ));

         $this->addColumn('website_id', array(
             'header' => $this->__('Website'),
             'align'  => 'left',
             'index'  => 'website_id',
             'type'    => 'options',
             'options' => Mage::getModel('Rugento_Multistock_Model_Source_Website')->toArray(),
         ));

        $this->addColumn('stock_city', array(
            'header' => $this->__('City'),
            'align'  => 'left',
            'index'  => 'stock_city'
        ));

        $this->addColumn('stock_country', array(
            'header' => $this->__('Country'),
            'align'  => 'left',
            'index'  => 'stock_country',
            'type'    => 'options',
            'options' => Mage::getModel('Rugento_Multistock_Model_Source_Country')->toArray(),
        ));

        $this->addColumn('status', array(
            'header' => $this->__('Status'),
            'align'  => 'left',
            'index'  => 'status',
            'type'    => 'options',
            'options' => Mage::getModel('Rugento_Multistock_Model_Source_Status')->toArray(),
        ));

        $this->addColumn('action',
                array(
                    'header'    => Mage::helper('catalog')->__('Action'),
                    'width'     => '50px',
                    'type'      => 'action',
                    'getter'     => 'getId',
                    'actions'   => array(
                        array(
                            'caption' => Mage::helper('catalog')->__('Edit'),
                            'url'     => array(
                                'base'=>'*/*/edit'
                            ),
                            'field'   => 'stock_id'
                        )
                    ),
                    'filter'    => false,
                    'sortable'  => false,
                ));

        return parent::_prepareColumns();
    }

    /*
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Grid::getRowUrl()
     */
    public function getRowUrl($row)
    {
        $url = $this->getUrl('*/*/edit', array(
            'stock_id' => $row->getStockId()
        ));
        return $url;
    }
}