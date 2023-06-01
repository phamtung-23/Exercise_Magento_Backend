<?php


namespace MyModule\ModuleCustomizeProductView\Controller\Product;

use Magento\Catalog\Controller\Product\View as OriginalView;

class View extends OriginalView
{
    public function execute()
    {
        // Add your custom logic here
        echo("Test customize view product");
        
        return parent::execute();
    }
}
