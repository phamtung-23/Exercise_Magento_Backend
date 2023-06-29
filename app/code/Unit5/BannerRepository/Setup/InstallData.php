<?php

namespace Unit5\BannerRepository\Setup;

// use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Unit5\BannerRepository\Model\BannerFactory;

class InstallData implements InstallDataInterface
{
    /* @var BannerFactory*/
    private $bannerFactory;

    /**
     * InstallData constructor.
     * @param BannerFactory $BannerFactory
     */
    public function __construct(BannerFactory $bannerFactory)
    {
        $this->bannerFactory = $bannerFactory;
    }


    /**
     * Function install
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            ['linkimg' => 'banner1.png','des'=>'banner1'],
            ['linkimg' => 'banner2.png','des'=>'banner2'],
            ['linkimg' => 'banner3.png','des'=>'banner3'],
            ['linkimg' => 'banner4.png','des'=>'banner4']];

        foreach($data as $item){
            $post = $this->bannerFactory->create();
            $post->addData($item)->save();
        }
        
    }
}