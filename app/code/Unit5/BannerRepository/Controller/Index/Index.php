<?php
namespace Unit5\BannerRepository\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Unit5\BannerRepository\Api\BannerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class Index extends Action
{
    /**
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * BannerController constructor.
     *
     * @param Context $context
     * @param BannerRepositoryInterface $bannerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context $context,
        BannerRepositoryInterface $bannerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    /**
     * Execute the controller action.
     */
    public function execute()
    {
        // dd('asdfasfasdfasdfasdfasdfasdf');
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $bannerList = $this->bannerRepository->getList($searchCriteria);

        // dd($bannerList->getItems());
        // Process the custom entity list as needed
        foreach ($bannerList->getItems() as $banner) {
            echo 'ID:'.$banner->getId().', Link image:'.$banner->getLinkImage().', description: '.$banner->getDescription().'</br>';

        }
    }
}