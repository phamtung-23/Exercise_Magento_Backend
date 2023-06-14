<?php

namespace Training\Vendor\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Extensionoption extends AbstractSource{
    protected $optionFacrory;

    public function getAllOptions()
    {
        $this->_options = [];
        
        $this->_options[] = ['label' => 'Vegan Friendly', 'value' => 'vegan'];
        $this->_options[] = ['label' => 'Made in UK', 'value' => 'madeinuk'];
        $this->_options[] = ['label' => 'Eco Friendly', 'value' => 'eco'];
    
    
        return $this->_options;
    }
}