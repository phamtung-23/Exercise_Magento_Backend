<?php
declare(strict_types=1);

namespace MyModule\ModuleThree\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RouterList;
use Psr\Log\LoggerInterface;


/**
 * Class Index
 */
class Index implements HttpGetActionInterface
{

     /**
      * @var _routerList
      */
    protected $_routerList;
    
    /**
     *  @var _logger
     */
    protected $_logger;

    const LOG_FILE = 'route.log';

    public function __construct(
        RouterList $routerList,
        LoggerInterface $logger
    ){
		$this->_routerList = $routerList;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        

        $list = '';
        foreach ($this->_routerList as $router) {
            $list.=get_class($router)."\n";
        }

        $this->_logger->info($list);
        $this->logIntoFile($list);
        // die("List of all available routers");
        var_dump($list);
        die("Saved list all of route into route3.log");
        // return $this->pageFactory->create();
    }

    public function logIntoFile($list){
        $logFilePath = BP . '/var/log/' . self::LOG_FILE;
        file_put_contents($logFilePath, $list, FILE_APPEND);
    }
}
