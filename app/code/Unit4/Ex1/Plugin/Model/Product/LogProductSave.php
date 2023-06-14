<?php
namespace Unit4\Ex1\Plugin\Model\Product;

use Psr\Log\LoggerInterface;
use \Magento\Catalog\Model\ResourceModel\Product;
use \Magento\Framework\DataObject ;

class LogProductSave
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * LogPageOutput constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeSave( Product $subject, DataObject $object) 
    {
       $result = array_udiff_assoc($object->getData(), $object->getOrigData(),
           function ($x,$y){
                return ($x === $y)? 0 : 1;
             }
           );
        $this->logger->debug(json_encode($result));
    }
}