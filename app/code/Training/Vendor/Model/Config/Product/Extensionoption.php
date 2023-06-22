<?php

namespace Training\Vendor\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Extensionoption extends AbstractSource{
    protected $optionFacrory;

    public function getAllOptions()
    {
        $this->_options = [];
        
        $this->_options[] = ['label' => 'Made in Viet Nam', 'value' => 'madeinvietnam'];
        $this->_options[] = ['label' => 'Made in UK', 'value' => 'madeinuk'];
        $this->_options[] = ['label' => 'Made in China', 'value' => 'madeinchina'];
    
    
        return $this->_options;
    }
}