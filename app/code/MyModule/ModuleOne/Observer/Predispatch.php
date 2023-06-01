<?php

 
namespace MyModule\ModuleOne\Observer;
 
use \Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;
 
 
class Predispatch implements ObserverInterface
{
    
    protected $logger;
    protected $request;
 
   
    public function __construct(LoggerInterface $logger, Http $request)
    {
        $this->logger = $logger;
        $this->request = $request;
    }
 
    public function execute(Observer $observer)
    {
        // echo $this->urlInterface->getCurrentUrl();

        // $request = $observer->getEvent()->getData('request');
        // $pathInfo = $request->getPathInfo();

        $url = $this->request->getPathInfo();

        $this->logger->info('Path: '.$url);
    }
}