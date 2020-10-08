<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Stock_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    /**
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId    = 'id';
        $this->_blockGroup  = 'multistock';
        $this->_controller  = 'adminhtml_stock';
        $this->_mode        = 'edit';

        $this->_updateButton('save', 'label', $this->__('Save'));

        if ($this->helper('multistock')->getCurrentStock() !== null && $this->helper('multistock')->getCurrentStock()->getId()) {
            $this->_addButton('delete', array(
                'label'   => $this->__('Delete'),
                'onclick' => 'if(confirm(\'' . Mage::helper('multistock')->__('Вы уверены?') . '\'))setLocation(\'' . $this->getUrl('*/*/delete', [
                    'stock_id' => $this->helper('multistock')
                        ->getCurrentStock()
                        ->getId()
                ]) . '\')',
                'class'   => 'delete'
            ));
        }

        $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save'
        ), - 100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /* (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Container::getHeaderText()
     */
    public function getHeaderText()
    {
        if ($this->helper('multistock')->getCurrentStock() !== null) {
            return $this->__('Edit Stock');
        } else {
            return $this->__('New Stock');
        }
    }
}