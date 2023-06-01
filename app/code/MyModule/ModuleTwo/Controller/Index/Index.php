<?php
declare(strict_types=1);

namespace MyModule\ModuleTwo\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RouterList;
use Psr\Log\LoggerInterface;


/**
 * Class Index
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
      * @var RequestInterface
      */
    private $request;

     /**
      * @var _routerList
      */
    protected $_routerList;
    
    /**
     *  @var _logger
     */
    protected $_logger;

    const LOG_FILE = 'router.log';
    /**
     * @param PageFactory $pageFactory
     * @param RequestInterface $request
     */
    public function __construct(
        PageFactory $pageFactory, 
        RequestInterface $request,
        RouterList $routerList,
        LoggerInterface $logger
    ){
        $this->pageFactory = $pageFactory;
        $this->request = $request;
		$this->_routerList = $routerList;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        // Get the params that were passed from our Router
        $firstParam = $this->request->getParam('first_param', null);
        $secondParam = $this->request->getParam('second_param', null);

        $list = '';
        foreach ($this->_routerList as $router) {
            $list.=get_class($router)."\n";
        }

        $this->_logger->info($list);
        $this->logIntoFile($list);
        // die("List of all available routers");

        return $this->pageFactory->create();
    }

    public function logIntoFile($list){
        $logFilePath = BP . '/var/log/' . self::LOG_FILE;
        file_put_contents($logFilePath, $list, FILE_APPEND);
    }
}
