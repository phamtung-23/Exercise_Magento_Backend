<?php
// File: app/code/VendorName/ModuleName/Controller/HelloWorld.php

namespace MyModule\ModuleHelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // $this->getResponse()->appendBody("HELLO WORLD");
        // dd($this->getRequest());

        $this->_redirect('catalog/product/view/id/2061');

    }
}