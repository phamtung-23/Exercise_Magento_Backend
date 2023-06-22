<?php
namespace MyModule\ModuleHelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Catalog\Model\CategoryRepository;

class Index extends Action
{
    protected $resultFactory;
    protected $productRepository;
    protected $urlInterface;
    protected $categoryRepository;
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        CategoryRepository $categoryRepository
    ) {
        $this->resultFactory = $resultFactory;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $categoryId = 42;
            $category = $this->categoryRepository->get($categoryId);
            $url = $category->getUrl();
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setUrl($url);
            return $resultRedirect;
        } catch (\Exception $e) {
            echo 'Category does not exist!!';
        }
    }
}