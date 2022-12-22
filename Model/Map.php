<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Model;

use Scandiweb\Slider\Api\Data\MapInterface;

class Map extends \Magento\Framework\Model\AbstractModel implements MapInterface
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Map');
    }

    /**
     * {@inheritdoc}
     */
    public function getSlideId()
    {
        return parent::getData(self::SLIDE_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setSlideId($slideId)
    {
        return $this->setData(self::SLIDE_ID, $slideId);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return parent::getData(self::TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoordinates()
    {
        return parent::getData(self::COORDINATES);
    }

    /**
     * {@inheritdoc}
     */
    public function setCoordinates($coordinates)
    {
        return $this->setData(self::COORDINATES, $coordinates);
    }

    /**
     * {@inheritdoc}
     */
    public function getIsActive()
    {
        return parent::getData(self::IS_ACTIVE);
    }

    /**
     * {@inheritdoc}
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductId()
    {
        return parent::getData(self::PRODUCT_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }
}
