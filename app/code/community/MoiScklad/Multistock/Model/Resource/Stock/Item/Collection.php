<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Model_Resource_Stock_Item_Collection extends Mage_CatalogInventory_Model_Resource_Stock_Item_Collection
{

    /**
     *
     * @return Rugento_Multistock_Model_Resource_Stock_Item_Collection
     */
    public function joinStock()
    {
        $this->getSelect()->joinLeft(array(
            'stock_table' => $this->getTable('cataloginventory/stock')
        ), 'main_table.stock_id=stock_table.stock_id', array(
            'stock_name'
        ));
        return $this;
    }

    /**
     *
     * @param unknown $store
     * @return Rugento_Multistock_Model_Resource_Stock_Item_Collection
     */
    public function selectStockFromStore($store)
    {
        $this->getSelect()->where('stock_id = ?', $store->getStockId());
        return $this;
    }

    /**
     *
     * @param unknown $type
     * @return Rugento_Multistock_Model_Resource_Stock_Item_Collection
     */
    public function joinProductType($type)
    {
        $this->getSelect()->join(array(
            'product' => 'catalog_product_entity'
        ), 'product.entity_id=main_table.product_id');
        $this->getSelect()->where('product.type_id = ?', $type);
        return $this;
    }

    /**
     *
     * @param unknown $category
     * @return Rugento_Multistock_Model_Resource_Stock_Item_Collection
     */
    public function addCategoryFilter($category)
    {
        $this->getSelect()->join(array(
            'category_product' => 'catalog_category_product'
        ), 'category_product.product_id=product.entity_id');
        $this->getSelect()->where('category_product.category_id = ?', $category->getId());
        return $this;
    }
}