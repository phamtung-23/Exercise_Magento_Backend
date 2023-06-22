<?php
declare(strict_types=1);

namespace MyModule\ModuleDashRouter\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
/**
 * Class Index
 */
class IndexDashTest implements HttpGetActionInterface
{
    private $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }
    public function execute()
    {
        return $this->pageFactory->create();
    }
}
