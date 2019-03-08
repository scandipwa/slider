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
 * @method int getMapId()
 * @method \Scandiweb\Slider\Model\Map setMapId(int $value)
 * @method int getSlideId()
 * @method \Scandiweb\Slider\Model\Map setSlideId(int $value)
 * @method string getTitle()
 * @method \Scandiweb\Slider\Model\Map setTitle(string $value)
 * @method string getCoordinates()
 * @method \Scandiweb\Slider\Model\Map setCoordinates(string $value)
 * @method bool getIsActive()
 * @method \Scandiweb\Slider\Model\Map setIsActive(bool $value)
 * @method int getProductId()
 * @method \Scandiweb\Slider\Model\Map setProductId(int $value)
 */
class Map extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Map');
    }
}
