<?php

/**
 *
 * @author RUGENTO
 */
class Rugento_Multistock_Model_Source_Type
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
                'label' => 'Физический склад'
            ),
            array(
                'value' => '1',
                'label' => 'Виртуальный склад'
            ),
            array(
                'value' => '2',
                'label' => 'Для информации'
            ),
            array(
                'value' => '3',
                'label' => 'Сумма остатков всех складов'
            )
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