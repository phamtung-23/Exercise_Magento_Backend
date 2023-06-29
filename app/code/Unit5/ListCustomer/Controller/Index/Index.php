<?php
namespace Unit5\ListCustomer\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use  Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\Search\FilterGroup;

class Index extends Action
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

 /**
     * @var FilterGroup
     */
    private $filterGroup;

    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepo,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        FilterGroup $filterGroup
    ) {
        $this->customerRepo = $customerRepo;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->filterGroup = $filterGroup;
        return parent::__construct($context);
    }

    public function execute()
    {
        $filter1 = $this->filterBuilder
            ->setField(CustomerInterface::FIRSTNAME)
            ->setConditionType('like')
            ->setValue('P%')
            ->create();

        $filter2 = $this->filterBuilder
            ->setField(CustomerInterface::EMAIL)
            ->setConditionType('like')
            ->setValue('r%')
            ->create();

        $sortOrder = $this->sortOrderBuilder
            ->setField('id')
            ->setAscendingDirection()
            ->create();

        $this->searchCriteriaBuilder->addFilters([$filter1, $filter2]);
        
        $this->searchCriteriaBuilder
            ->setSortOrders([$sortOrder]);

        $searchCriteria = $this->searchCriteriaBuilder->create();

        $customerItems  = $this->customerRepo->getList($searchCriteria)->getItems();

        foreach ($customerItems as $customerItem){
            echo "ID: ".$customerItem->getID()
                    .", Email: ".$customerItem->getEmail()
                    .", Name: ".$customerItem->getFirstname()." ".$customerItem->getLastname()."</br>";
        }
    }
}
