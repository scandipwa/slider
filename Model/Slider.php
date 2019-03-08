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

/**
 * @method int getSliderId()
 * @method \Scandiweb\Slider\Model\Slider setSliderId(int $value)
 * @method int getBlockId()
 * @method \Scandiweb\Slider\Model\Slider setBlockId(int $value)
 * @method string getTitle()
 * @method \Scandiweb\Slider\Model\Slider setTitle(string $value)
 * @method bool getIsActive()
 * @method \Scandiweb\Slider\Model\Slider setIsActive(bool $value)
 * @method bool getShowMenu()
 * @method \Scandiweb\Slider\Model\Slider setShowMenu(bool $value)
 * @method bool getShowNavigation()
 * @method \Scandiweb\Slider\Model\Slider setShowNavigation(bool $value)
 * @method int getSlideSpeed()
 * @method \Scandiweb\Slider\Model\Slider setSlideSpeed(int $value)
 * @method int getPosition()
 * @method \Scandiweb\Slider\Model\Slider setPosition(int $value)
 * @method int getAnimationSpeed()
 * @method \Scandiweb\Slider\Model\Slider setAnimationSpeed(int $value)
 * @method int getSlidesToDisplay()
 * @method \Scandiweb\Slider\Model\Slider setSlidesToDisplay(int $value)
 * @method int getSlidesToScroll()
 * @method \Scandiweb\Slider\Model\Slider setSlidesToScroll(int $value)
 * @method bool getLazyLoad()
 * @method \Scandiweb\Slider\Model\Slider setLazyLoad(bool $value)
 * @method int getSlidesToDisplayTablet()
 * @method \Scandiweb\Slider\Model\Slider setSlidesToDisplayTablet(int $value)
 * @method int getSlidesToScrollTablet()
 * @method \Scandiweb\Slider\Model\Slider setSlidesToScrollTablet(int $value)
 * @method int getSlidesToDisplayMobile()
 * @method \Scandiweb\Slider\Model\Slider setSlidesToDisplayMobile(int $value)
 * @method int getSlidesToScrollMobile()
 * @method \Scandiweb\Slider\Model\Slider setSlidesToScrollMobile(int $value)
 */
class Slider extends \Magento\Framework\Model\AbstractModel
{
    const MEDIA_PATH = 'scandiweb/slider';

    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slider');
    }
}
