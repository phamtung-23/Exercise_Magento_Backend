<?php
namespace MyModule\Moduleone\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CaptureHtmlOutputObserver implements ObserverInterface
{
    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $response = $observer->getData('response');
        $body = $response->getBody();

        // Log the captured HTML
        $this->_logger->info($body);
    }
}
