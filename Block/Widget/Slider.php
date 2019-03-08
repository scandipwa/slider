<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @author      Raivis Dejus <info@scandiweb.com>
 * @copyright   Copyright (c) 2018 Scandiweb, Ltd (https://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Widget;

class Slider extends \Scandiweb\Slider\Block\Slider implements \Magento\Widget\Block\BlockInterface
{
    /* @var string $_template */
    protected $_template = 'Scandiweb_Slider::slider.phtml';

    /**
     * Will get entry for <img> tag srcSet for particular slider image and size
     * @param $imageUrl
     * @param $size
     * @return string
     */
    public function getSrcSetEntry($imageUrl, $size){

        $extension_position = \strrpos($imageUrl, '.');
        $imageBaseUrl = \substr($imageUrl, 0, $extension_position);
        $extension = \substr($imageUrl, $extension_position);

        return \sprintf('%s-%sw%s %sw,', $imageBaseUrl, $size, $extension, $size);
    }
}
