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
 * @method int getSlideId()
 * @method \Scandiweb\Slider\Model\Slider setSlideId(int $value)
 * @method int getSliderId()
 * @method \Scandiweb\Slider\Model\Slider setSliderId(int $value)
 * @method string getTitle()
 * @method \Scandiweb\Slider\Model\Slider setTitle(string $value)
 * @method string getImage()
 * @method \Scandiweb\Slider\Model\Slider setImage(string $value)
 * @method string getImage2()
 * @method \Scandiweb\Slider\Model\Slider setImage2(string $value)
 * @method string getImage3()
 * @method \Scandiweb\Slider\Model\Slider setImage3(string $value)
 * @method bool getIsActive()
 * @method \Scandiweb\Slider\Model\Slider setIsActive(bool $value)
 * @method int getPosition()
 * @method \Scandiweb\Slider\Model\Slider setPosition(int $value)
 * @method string getStartTime()
 * @method \Scandiweb\Slider\Model\Slider setStartTime(string $value)
 * @method string getEndTime()
 * @method \Scandiweb\Slider\Model\Slider setEndTime(string $value)
 * @method string getSlideLink()
 * @method \Scandiweb\Slider\Model\Slider setSlideLink(string $value)
 * @method string getSlideLink2()
 * @method \Scandiweb\Slider\Model\Slider setSlideLink2(string $value)
 * @method string getSlideLink3()
 * @method \Scandiweb\Slider\Model\Slider setSlideLink3(string $value)
 * @method string getDisplayTitle()
 * @method \Scandiweb\Slider\Model\Slider setDisplayTitle(string $value)
 * @method string getDisplayTitle2()
 * @method \Scandiweb\Slider\Model\Slider setDisplayTitle2(string $value)
 * @method string getDisplayTitle3()
 * @method \Scandiweb\Slider\Model\Slider setDisplayTitle3(string $value)
 * @method string getSlideText()
 * @method \Scandiweb\Slider\Model\Slider setSlideText(string $value)
 * @method string getSlideText2()
 * @method \Scandiweb\Slider\Model\Slider setSlideText2(string $value)
 * @method string getSlideText3()
 * @method \Scandiweb\Slider\Model\Slider setSlideText3(string $value)
 * @method string getEmbedCode()
 * @method \Scandiweb\Slider\Model\Slider setEmbedCode(string $value)
 * @method string getEmbedCode2()
 * @method \Scandiweb\Slider\Model\Slider setEmbedCode2(string $value)
 * @method string getEmbedCode3()
 * @method \Scandiweb\Slider\Model\Slider setEmbedCode3(string $value)
 * @method int getSlideTextPosition()
 * @method \Scandiweb\Slider\Model\Slider setSlideTextPosition(int $value)
 * @method int getSlideTextPosition2()
 * @method \Scandiweb\Slider\Model\Slider setSlideTextPosition2(int $value)
 * @method int getSlideTextPosition3()
 * @method \Scandiweb\Slider\Model\Slider setSlideTextPosition3(int $value)
 * @method string getSlideWidthClass()
 * @method \Scandiweb\Slider\Model\Slider setSlideWidthClass(string $value)
 */
class Slide extends \Magento\Framework\Model\AbstractModel
{
    /* @var \Magento\Store\Model\StoreManagerInterface $_storeManager */
    protected $_storeManager;

    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slide');
    }

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Scandiweb\Slider\Model\ResourceModel\Slide $resource
     * @param \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Scandiweb\Slider\Model\ResourceModel\Slide $resource = null,
        \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $resourceCollection = null,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @param  bool $secure
     * @return string|bool
     */
    public function getImageUrl($secure = false)
    {
        if (!$this->getImage()) {
            return false;
        }

        $base = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA, $secure);

        return $base . $this->getImage();
    }

    /**
     * @param  bool $secure
     * @return string|bool
     */
    public function getImageUrl2($secure = false)
    {
        if (!$this->getImage2()) {
            return false;
        }

        $base = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA, $secure);

        return $base . $this->getImage2();
    }

    /**
     * @param  bool $secure
     * @return string|bool
     */
    public function getImageUrl3($secure = false)
    {
        if (!$this->getImage3()) {
            return false;
        }

        $base = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA, $secure);

        return $base . $this->getImage3();
    }

    /**
     * Will return an array of widths the original image should be resized to
     * @return array
     */
    protected function getSupportedSizes()
    {
        return [375, 768, 1024];
    }

    /**
     * Will resize images to various sizes for later use in <img> stcsets
     * @param $originalImagePath
     * @throws \Exception
     */
    public function prepareImagesForSrcset($originalImagePath)
    {
        $image = new \claviska\SimpleImage();
        $fileNameParts = \pathinfo($originalImagePath);

        foreach ($this->getSupportedSizes() as $size) {
            $newFileName = $fileNameParts['dirname'] . '/' .
                $fileNameParts['filename'] . '-' . $size . 'w.' . $fileNameParts['extension'];

            $image
                ->fromFile($originalImagePath)
                ->resize($size)
                ->toFile($newFileName, \mime_content_type($originalImagePath));
        }
    }
}
