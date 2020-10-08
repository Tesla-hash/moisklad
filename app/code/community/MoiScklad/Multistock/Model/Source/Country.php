<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Model_Source_Country extends Mage_Adminhtml_Model_System_Config_Source_Country
{
    /**
     * @return multitype:multitype:string
     */
    public function toArray()
    {
        $array = [];
        foreach ($this->toOptionArray(true) as $item) {
            $array[$item['value']] = $item['label'];
        }
        return $array;
    }
}