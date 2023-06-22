<?php
declare(strict_types=1);

namespace MyModule\ListRouter\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RouterList;
use Psr\Log\LoggerInterface;

class Index implements HttpGetActionInterface
{
    protected $_routerList;
    
    protected $_logger;

    public function __construct(RouterList $routerList, LoggerInterface $logger){
		$this->_routerList = $routerList;
        $this->_logger = $logger;
    }
    public function execute()
    {
        $list = '';
        foreach ($this->_routerList as $router) {
            $list.=get_class($router)."\n";
        }
        $this->_logger->info($list);
        dd($list);
    }
}
