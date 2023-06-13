<?php
namespace MyModule\NewBlock\Block;

use Magento\Framework\View\Element\AbstractBlock;

class Index extends AbstractBlock
{
    protected function _toHtml()
    {
        
        $html = '<div>This is my custom block!</div>';
        return $html;
    }
}