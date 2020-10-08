<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Model_Source_Website
{

    /**
     *
     * @return multitype:multitype:string
     */
    public function toArray()
    {
        $website = [
            '9999999' => 'Без привязки',
        ];
        foreach (Mage::app()->getWebsites(true) as $value) {
            if (! is_object($value) || (Mage::app()->isSingleStoreMode() && $value->getId() != 0)) {
                continue;
            }
            if ($value->getId() == 0) {
                $value->setName(Mage::helper('multistock')->__('Default'));
            }
            $website[$value->getId()] = $value->getName(). ' ('.$value->getId().')';
        }
        return $website;
    }
}