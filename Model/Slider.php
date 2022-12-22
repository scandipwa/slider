<?php
/**
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Scandiweb\Slider\Api\Data\SliderInterface;

class Slider extends AbstractModel implements SliderInterface, IdentityInterface
{
    /**
     * Slider cache tag
     */
    const CACHE_TAG = 'sw_sldr';

    const MEDIA_PATH = 'scandiweb/slider';

    /**
     * @var string
     */
    protected $_cacheTag = 'scandiweb_slider_slider';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'scandiweb_slider_slider';

    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slider');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
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
    public function getSlideSpeed()
    {
        return parent::getData(self::SLIDE_SPEED);
    }

    /**
     * {@inheritdoc}
     */
    public function setSlideSpeed($speed)
    {
        return $this->setData(self::SLIDE_SPEED, $speed);
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return parent::getData(self::POSITION);
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * {@inheritdoc}
     */
    public function getAnimationSpeed()
    {
        return parent::getData(self::ANIMATION_SPEED);
    }

    /**
     * {@inheritdoc}
     */
    public function setAnimationSpeed($speed)
    {
        return $this->setData(self::ANIMATION_SPEED, $speed);
    }

    /**
     * {@inheritdoc}
     */
    public function getIsMenuShown()
    {
        return parent::getData(self::SHOW_MENU);
    }

    /**
     * {@inheritdoc}
     */
    public function setIsMenuShown($isMenuShown)
    {
        return $this->setData(self::SHOW_MENU, $isMenuShown);
    }

    /**
     * {@inheritdoc}
     */
    public function getIsNavigationShown()
    {
        return parent::getData(self::SHOW_NAVIGATION);
    }

    /**
     * {@inheritdoc}
     */
    public function setIsNavigationShown($isNavigationShown)
    {
        return $this->setData(self::SHOW_NAVIGATION, $isNavigationShown);
    }

    /**
     * {@inheritdoc}
     */
    public function getDesktopSlidesNum()
    {
        return parent::getData(self::SLIDES_TO_DISPLAY);
    }

    /**
     * {@inheritdoc}
     */
    public function setDesktopSlidesNum($slidesNum)
    {
        return $this->setData(self::SLIDES_TO_DISPLAY, $slidesNum);
    }

    /**
     * {@inheritdoc}
     */
    public function getDesktopScrollSlidesNum()
    {
        return parent::getData(self::SLIDES_TO_SCROLL);
    }

    /**
     * {@inheritdoc}
     */
    public function setDesktopScrollSlidesNum($slidesNum)
    {
        return $this->setData(self::SLIDES_TO_SCROLL, $slidesNum);
    }

    /**
     * {@inheritdoc}
     */
    public function getIsLazyLoaded()
    {
        return parent::getData(self::LAZY_LOAD);
    }

    /**
     * {@inheritdoc}
     */
    public function setIsLazyLoaded($isLazyLoaded)
    {
        return $this->setData(self::LAZY_LOAD, $isLazyLoaded);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabletSlidesNum()
    {
        return parent::getData(self::SLIDES_TO_DISPLAY_TABLET);
    }

    /**
     * {@inheritdoc}
     */
    public function setTabletSlidesNum($slidesNum)
    {
        return $this->setData(self::SLIDES_TO_DISPLAY_TABLET, $slidesNum);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabletScrollSlidesNum()
    {
        return parent::getData(self::SLIDES_TO_SCROLL_TABLET);
    }

    /**
     * {@inheritdoc}
     */
    public function setTabletScrollSlidesNum($slidesNum)
    {
        return $this->setData(self::SLIDES_TO_SCROLL_TABLET, $slidesNum);
    }

    /**
     * {@inheritdoc}
     */
    public function getMobileSlidesNum()
    {
        return parent::getData(self::SLIDES_TO_DISPLAY_MOBILE);
    }

    /**
     * {@inheritdoc}
     */
    public function setMobileSlidesNum($slidesNum)
    {
        return $this->setData(self::SLIDES_TO_DISPLAY_MOBILE, $slidesNum);
    }

    /**
     * {@inheritdoc}
     */
    public function getMobileScrollSlidesNum()
    {
        return parent::getData(self::SLIDES_TO_SCROLL_MOBILE);
    }

    /**
     * {@inheritdoc}
     */
    public function setMobileScrollSlidesNum($slidesNum)
    {
        return $this->setData(self::SLIDES_TO_SCROLL_MOBILE, $slidesNum);
    }
}
