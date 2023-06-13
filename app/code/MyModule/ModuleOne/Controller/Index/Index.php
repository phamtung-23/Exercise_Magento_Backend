<?php
namespace MyModule\ModuleOne\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Psr\Log\LoggerInterface;
use \Magento\UrlRewrite\Model\UrlRewriteFactory;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ResourceConnection;

class Index extends Action
{
	protected $_pageFactory;
	protected $logger;
	protected $_routerList;
	protected $_urlRewriteFactory;
	protected $resourceConnection;

	public function __construct(
		Context $context,
		PageFactory $pageFactory,
		LoggerInterface $logger,
		UrlRewriteFactory $urlRewriteFactory,
		ResourceConnection $resourceConnection)
	{
		$this->_pageFactory = $pageFactory;
		$this->logger = $logger;
		$this->_urlRewriteFactory = $urlRewriteFactory;
		$this->resourceConnection = $resourceConnection;
		return parent::__construct($context);
	}

	public function execute()
	{
		// dd($this->getRequest());
		$connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('url_rewrite'); // Replace with the actual table name
        $yourPath = ltrim($this->getRequest()->getPathInfo(),'/');
		// dd($yourTargetPath);
        $query = $connection->select()
            ->from($tableName)
            ->where('target_path = ?', $yourPath); // Replace with your condition
        
        $result = $connection->fetchAll($query);


		if(count($result)>0 || $yourPath=="phamtung"){
			return $this->_pageFactory->create();
		}
		else{
			$urlRewriteModel = $this->_urlRewriteFactory->create();~
			/* set current store id */
			$urlRewriteModel->setStoreId(1);
			/* this url is not created by system so set as 0 */
			$urlRewriteModel->setIsSystem(0);
			/* unique identifier - set random unique value to id path */
			$urlRewriteModel->setIdPath(rand(1, 100000));
			/* set actual url path to target path field */
			$urlRewriteModel->setTargetPath("phamtung/index/index");
			/* set requested path which you want to create */
			$urlRewriteModel->setRequestPath("phamtung-info");
			/* set current store id */
			$urlRewriteModel->save();
			return $this->_pageFactory->create();
		}
	}

	// protected function getRoutersString()
    // {
    //     $ret = '';
    //     foreach ($this->_routerList as $router) {
    //         $ret .= get_class($router)."\n";
    //     }
    //     return $ret;
    // }
}