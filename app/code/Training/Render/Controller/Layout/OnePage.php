<?php

namespace Training\Render\Controller\Layout;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Cms\Model\BlockFactory;


class OnePage extends Action
{
    
    protected $resultPageFactory;
    protected $blockFactory;

    
    public function __construct(Context $context, PageFactory $resultPageFactory, BlockFactory $blockFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->blockFactory = $blockFactory;
        return parent::__construct($context);
    }

    
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $blockId = 'test.new.block'; 
        $block = $resultPage->getLayout()->createBlock(\Magento\Cms\Block\Block::class)->setBlockId($blockId);
        $resultPage->getLayout()->setChild('content',$block->getNameInLayout(), $block);
        return $resultPage;
    }
}