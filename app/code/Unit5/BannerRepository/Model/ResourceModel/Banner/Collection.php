<?php

namespace Unit5\BannerRepository\Model\ResourceModel\Banner;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Unit5\BannerRepository\Model\Banner',
            'Unit5\BannerRepository\Model\ResourceModel\Banner');
    }
}