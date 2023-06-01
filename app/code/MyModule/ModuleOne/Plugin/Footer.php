<?php
 
namespace MyModule\ModuleOne\Plugin;
 
class Footer
{
    public function afterGetCopyright(\Magento\Theme\Block\Html\Footer $subject, $result)
    {
        return 'Customized copyright!!!!';
    }
}