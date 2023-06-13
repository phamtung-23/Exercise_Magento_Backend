<?php

namespace MyModule\ModuleOne\Plugin;

use Magento\Catalog\Block\Product\View as ProductView;
use Psr\Log\LoggerInterface;

class LoggedLayoutXML
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeToHtml(ProductView $subject)
    {
        $layout = $subject->getLayout();
        // dd($layout);
        $xml = $layout->getXmlString();
        $this->logger->debug('Product View XML: ' . $xml);
    }
}