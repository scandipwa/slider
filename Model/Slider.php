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

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * @method int getSliderId()
 * @method Slider setSliderId(int $value)
 * @method int getBlockId()
 * @method Slider setBlockId(int $value)
 * @method string getTitle()
 * @method Slider setTitle(string $value)
 * @method bool getIsActive()
 * @method Slider setIsActive(bool $value)
 * @method bool getShowMenu()
 * @method Slider setShowMenu(bool $value)
 * @method bool getShowNavigation()
 * @method Slider setShowNavigation(bool $value)
 * @method int getSlideSpeed()
 * @method Slider setSlideSpeed(int $value)
 * @method int getPosition()
 * @method Slider setPosition(int $value)
 * @method int getAnimationSpeed()
 * @method Slider setAnimationSpeed(int $value)
 * @method int getSlidesToDisplay()
 * @method Slider setSlidesToDisplay(int $value)
 * @method int getSlidesToScroll()
 * @method Slider setSlidesToScroll(int $value)
 * @method bool getLazyLoad()
 * @method Slider setLazyLoad(bool $value)
 * @method int getSlidesToDisplayTablet()
 * @method Slider setSlidesToDisplayTablet(int $value)
 * @method int getSlidesToScrollTablet()
 * @method Slider setSlidesToScrollTablet(int $value)
 * @method int getSlidesToDisplayMobile()
 * @method Slider setSlidesToDisplayMobile(int $value)
 * @method int getSlidesToScrollMobile()
 * @method Slider setSlidesToScrollMobile(int $value)
 */
class Slider extends AbstractModel implements IdentityInterface
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
}
