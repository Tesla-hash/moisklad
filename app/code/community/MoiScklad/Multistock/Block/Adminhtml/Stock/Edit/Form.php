<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Block_Adminhtml_Stock_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /*
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Form::_prepareForm()
     */
    protected function _prepareForm()
    {
        $stockId = '';
        if ($this->getRequest()->getActionName() == 'edit') {
            $stockId = array(
                'stock_id' => $this->getRequest()->getParam('stock_id')
            );
        }
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', $stockId),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}