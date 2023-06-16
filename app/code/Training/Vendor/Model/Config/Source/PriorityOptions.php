<?php

namespace Training\Vendor\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class PriorityOptions extends AbstractSource
{
    public function getAllOptions()
    {
        // $options = [];
        // for ($i = 1; $i <= 10; $i++) {
        //     $options[] = [
        //         'label' => $i,
        //         'value' => $i
        //     ];
        // }
        // return $options;

        $this->_options = [];
        

        for ($x = 1; $x <= 10; $x+=1) {
            $this->_options[] = ['label' => strval($x), 'value' => $x];

        }
    
    
        return $this->_options;
    }
}