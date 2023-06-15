<?php

namespace Training\Vendor\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Multiselect extends Template
{
    protected $registry;

    protected $product;

    public function __construct(Template\Context $context, Registry $registry, array $data)
    {
        $this->registry = $registry;
        parent::__construct($context, $data);        
    }

    public function getProduct(){
        if(is_null($this->product)){
            $this->product = $this->registry->registry('product');

            if(!$this->product->getId()){
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

    public function getProductMultiselect(){
        return $this->getProduct()->getData('Multiselect_product_origin_attribute');
    }
}