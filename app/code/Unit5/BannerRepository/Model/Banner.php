<?php

namespace Unit5\BannerRepository\Model;

use \Magento\Framework\Model\AbstractModel;
use Unit5\BannerRepository\Api\Data\BannerInterface;

class Banner extends AbstractModel implements BannerInterface
{
    /**
     * Initialize resource model
     * @return void
     */
    public function _construct()
    {
        $this->_init('Unit5\BannerRepository\Model\ResourceModel\Banner');
    }

    /**
     * Get entity ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('entity_id');
    }

    /**
     * Set entity ID.
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id)
    {
        return $this->setData('entity_id', $id);
    }


    /**
     * Get link image.
     *
     * @return string|null
     */
    public function getLinkImage(){
        return $this->getData('linkimg').'tesst!!!!!';
    }

    /**
     * Set link image .
     *
     * @param string $linkimg
     * @return BannerInterface
     */
    public function setLinkimg($linkimg){
        return $this->setData('linkimg', $linkimg);
    }


      /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription(){
        return $this->getData('des');
    }

    /**
     * Set description .
     *
     * @param string $des
     * @return BannerInterface
     */
    public function setDescription($des){
        return $this->setData('des', $des);
    }

}