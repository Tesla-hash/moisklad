<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Adminhtml_MultistockController extends Mage_Adminhtml_Controller_Action
{

    /**
     */
    public function indexAction()
    {
        $this
             ->loadLayout()
             ->_addContent($this->getLayout()->createBlock('multistock/adminhtml_stock'))
             ->renderLayout()
        ;
    }

    /**
     */
    public function newAction()
    {
         $this
             ->loadLayout()
             ->renderLayout()
        ;
    }

    /**
     */
    public function editAction()
    {
        $id    = $this->getRequest()->getParam('stock_id');
        $model = Mage::getModel('multistock/stock');

        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This stock no longer exists!'));
                $this->_redirect('*/*/');
                return;
            }
        }

        Mage::helper('multistock')->setCurrentStock($model);
        $this
            ->loadLayout()
            ->_title($model->getId() ? $model->getName() : $this->__('New Stock'))
            ->renderLayout()
        ;
    }

    /**
     */
    public function saveAction()
    {
        $stockId      = $this->getRequest()->getParam('stock_id', null);
        $redirectBack = $this->getRequest()->getParam('back', false);
        $postData     = $this->getRequest()->getPost();
        if ($postData) {
            try {
                $stock = Mage::getModel('multistock/stock');
                $stock->setData($postData);
                $stock->setId($stockId);
                $stock->save();
                $stockId = $stock->getId();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The stock has been saved.'));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::logException($e);
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this stock.'));
                Mage::logException($e);
            }
            if ($redirectBack) {
                $this->_redirect('*/*/edit', array(
                    'stock_id' => $stockId,
                    '_current' => true
                ));
                return ;
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('stock_id');
        if ($id) {
            $stock = Mage::getModel('multistock/stock')->load($id);
            try {
                $stock->delete();
                $this->_getSession()->addSuccess($this->__('The stock has been deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}