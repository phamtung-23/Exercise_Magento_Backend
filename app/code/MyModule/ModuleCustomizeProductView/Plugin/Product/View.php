<?php
namespace MyModule\ModuleCustomizeProductView\Plugin\Product;

class View
{
    public function afterExecute(\Magento\Catalog\Controller\Product\View $subject, $result)
    {
        echo "</br>"."Test add text plugin!!!";
        return $result;
    }
}