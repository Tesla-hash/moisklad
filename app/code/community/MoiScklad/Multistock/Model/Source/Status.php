<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Model_Source_Status
{
    /**
     *
     * @return multitype:multitype:string
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '0',
                'label' => 'Выключен'
            ),
            array(
                'value' => '1',
                'label' => 'Включен'
            ),
        );
    }

    /**
     * @return multitype:multitype:string
     */
    public function toArray()
    {
        $array = [];
        foreach ($this->toOptionArray() as $item) {
            $array[$item['value']] = $item['label'];
        }
        return $array;
    }
}