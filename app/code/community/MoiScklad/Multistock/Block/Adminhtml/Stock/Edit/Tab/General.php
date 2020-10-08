<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_MultiStock_Block_Adminhtml_Stock_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Form::_prepareForm()
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('multistock_form', array(
            'legend' => $this->__('General')
        ));

        $fieldset->addField('stock_name', 'text', array(
            'label'     => $this->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'stock_name'
        ));

        $fieldset->addField('stock_code', 'text', array(
            'label'     => $this->__('Code'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'stock_code'
        ));

        $fieldset->addField('website_id', 'select', array(
            'label'     => $this->__('Website'),
            'class'     => 'action-select',
            'required'  => false,
            'name'      => 'website_id',
            'values'    => Mage::getModel('Rugento_Multistock_Model_Source_Website')->toArray()
        ));

        $fieldset->addField('stock_type', 'select', array(
            'label'     => $this->__('Stock Type'),
            'class'     => 'action-select',
            'required'  => false,
            'name'      => 'stock_type',
            'values'    => Mage::getModel('Rugento_Multistock_Model_Source_Type')->toArray()
        ));

        $fieldset->addField('stock_country', 'select', array(
            'label'     => $this->__('Country'),
            'class'     => 'action-select',
            'required'  => false,
            'name'      => 'stock_country',
            'values'    => Mage::getModel('Rugento_Multistock_Model_Source_Country')->toArray()
        ));

        $fieldset->addField('stock_city', 'text', array(
            'label'     => $this->__('City'),
            'class'     => '',
            'required'  => false,
            'name'      => 'stock_city'
        ));

        $fieldset->addField('stock_postcode', 'text', array(
            'label'     => $this->__('Postcode'),
            'class'     => '',
            'required'  => false,
            'name'      => 'stock_postcode'
        ));

        $fieldset->addField('stock_address', 'textarea', array(
            'label'     => $this->__('Address'),
            'class'     => '',
            'required'  => false,
            'name'      => 'stock_address'
        ));

        $fieldset->addField('uid', 'text', array(
            'label'     => $this->__('Stock Uid'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'uid'
        ));

        $fieldset->addField('latitude', 'text', array(
            'label'     => $this->__('Latitude'),
            'class'     => '',
            'required'  => false,
            'name'      => 'latitude'
        ));

        $fieldset->addField('longitude', 'text', array(
            'label'     => $this->__('Longitude'),
            'class'     => '',
            'required'  => false,
            'name'      => 'longitude'
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => $this->__('Status'),
            'class'     => 'action-select',
            'required'  => false,
            'name'      => 'status',
            'values'    => [
                '0' => 'Выключен',
                '1' => 'Включен',
            ]
        ));

        $this->setForm($form);

        $stockData = $this->helper('multistock')->getCurrentStock();
        if ($stockData) {
            $form->setValues($stockData);
        }
        return parent::_prepareForm();
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::getTabLabel()
     */
    public function getTabLabel()
    {
        return $this->__('General Information');
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::getTabTitle()
     */
    public function getTabTitle()
    {
        return $this->__('General Information');
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::isHidden()
     */
    public function isHidden()
    {
        return false;
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Tab_Interface::canShowTab()
     */
    public function canShowTab()
    {
        return true;
    }
}