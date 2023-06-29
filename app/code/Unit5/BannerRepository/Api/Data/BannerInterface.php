<?php
namespace Unit5\BannerRepository\Api\Data;

interface BannerInterface
{
    /**
     * Get entity ID.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set entity ID.
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id);


    /**
     * Get link image.
     *
     * @return string|null
     */
    public function getLinkImage();

    /**
     * Set link image .
     *
     * @param string $linkimg
     * @return BannerInterface
     */
    public function setLinkimg($linkimg);

     /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description .
     *
     * @param string $des
     * @return BannerInterface
     */
    public function setDescription($des);
}