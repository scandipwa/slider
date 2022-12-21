<?php
/**
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

declare(strict_types=1);

namespace Scandiweb\Slider\Model;

use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Scandiweb\Slider\Api\Data\SlideInterface;
use Scandiweb\Slider\Model\ResourceModel\Slide as SlideResourceModel;
use Scandiweb\Slider\Model\ResourceModel\Slide\Collection as SlideCollection;

/**
 * @method int getSliderId()
 * @method \Scandiweb\Slider\Model\Slider setSliderId(int $value)
 * @method string getTitle()
 * @method \Scandiweb\Slider\Model\Slider setTitle(string $value)
 * @method bool getIsActive()
 * @method \Scandiweb\Slider\Model\Slider setIsActive(bool $value)
 * @method int getPosition()
 * @method \Scandiweb\Slider\Model\Slider setPosition(int $value)
 * @method string getStartTime()
 * @method \Scandiweb\Slider\Model\Slider setStartTime(string $value)
 * @method string getEndTime()
 * @method \Scandiweb\Slider\Model\Slider setEndTime(string $value)
 */
class Slide extends AbstractModel implements SlideInterface, IdentityInterface
{
    /**
     * Slide cache tag
     */
    const CACHE_TAG = 'sw_sld';

    /**
     * Array of widths image should be resized to
     */
    const SUPPORTED_IMAGE_SIZES = [375, 768, 1024];

    /**
     * @var string
     */
    protected $_cacheTag = 'scandiweb_slider_slide';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'scandiweb_slider_slide';

    /**
     * @var StoreManagerInterface
     */
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
        Context $context,
        Registry $registry,
        SlideResourceModel $resource = null,
        SlideCollection $resourceCollection = null,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );

        $this->_storeManager = $storeManager;
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId(), Slider::CACHE_TAG . '_' . $this->getSliderId()];
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstDesktopImageLocation()
    {
        return parent::getData(self::FIRST_DESKTOP_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstDesktopImageLocation($image)
    {
        return $this->setData(self::FIRST_DESKTOP_IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstMobileImageLocation()
    {
        return parent::getData(self::FIRST_MOBILE_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstMobileImageLocation($image)
    {
        return $this->setData(self::FIRST_MOBILE_IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstLink()
    {
        return parent::getData(self::FIRST_LINK);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstLink($link)
    {
        return $this->setData(self::FIRST_LINK, $link);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstLinkText()
    {
        return parent::getData(self::FIRST_LINK_TEXT);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstLinkText($text)
    {
        return $this->setData(self::FIRST_LINK_TEXT, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstTitle()
    {
        return parent::getData(self::FIRST_DISPLAY_TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstTitle($title)
    {
        return $this->setData(self::FIRST_DISPLAY_TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstText()
    {
        return parent::getData(self::FIRST_TEXT);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstText($text)
    {
        return $this->setData(self::FIRST_TEXT, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstEmbedCode()
    {
        return parent::getData(self::FIRST_EMBED_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstEmbedCode($embedCode)
    {
        return $this->setData(self::FIRST_EMBED_CODE, $embedCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstTextPosition()
    {
        return parent::getData(self::FIRST_TEXT_POSITION);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstTextPosition($position)
    {
        return $this->setData(self::FIRST_TEXT_POSITION, $position);
    }

    /**
     * {@inheritdoc}
     */
    public function getWidthClass()
    {
        return parent::getData(self::WIDTH_CLASS);
    }

    /**
     * {@inheritdoc}
     */
    public function setWidthClass($widthClass)
    {
        return $this->setData(self::WIDTH_CLASS, $widthClass);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondDesktopImageLocation()
    {
        return parent::getData(self::SECOND_DESKTOP_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondDesktopImageLocation($image)
    {
        return $this->setData(self::SECOND_DESKTOP_IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondMobileImageLocation()
    {
        return parent::getData(self::SECOND_MOBILE_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondMobileImageLocation($image)
    {
        return $this->setData(self::SECOND_MOBILE_IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondLink()
    {
        return parent::getData(self::SECOND_LINK);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondLink($link)
    {
        return $this->setData(self::SECOND_LINK, $link);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondLinkText()
    {
        return parent::getData(self::SECOND_LINK_TEXT);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondLinkText($text)
    {
        return $this->setData(self::SECOND_LINK_TEXT, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondTitle()
    {
        return parent::getData(self::SECOND_DISPLAY_TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondTitle($title)
    {
        return $this->setData(self::SECOND_DISPLAY_TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondText()
    {
        return parent::getData(self::SECOND_TEXT);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondText($text)
    {
        return $this->setData(self::SECOND_TEXT, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondEmbedCode()
    {
        return parent::getData(self::SECOND_EMBED_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondEmbedCode($embedCode)
    {
        return $this->setData(self::SECOND_EMBED_CODE, $embedCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondTextPosition()
    {
        return parent::getData(self::SECOND_TEXT_POSITION);
    }

    /**
     * {@inheritdoc}
     */
    public function setSecondTextPosition($position)
    {
        return $this->setData(self::SECOND_TEXT_POSITION, $position);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdDesktopImageLocation()
    {
        return parent::getData(self::THIRD_DESKTOP_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdDesktopImageLocation($image)
    {
        return $this->setData(self::THIRD_DESKTOP_IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdMobileImageLocation()
    {
        return parent::getData(self::THIRD_MOBILE_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdMobileImageLocation($image)
    {
        return $this->setData(self::THIRD_MOBILE_IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdLink()
    {
        return parent::getData(self::THIRD_LINK);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdLink($link)
    {
        return $this->setData(self::THIRD_LINK, $link);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdLinkText()
    {
        return parent::getData(self::THIRD_LINK_TEXT);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdLinkText($text)
    {
        return $this->setData(self::THIRD_LINK_TEXT, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdTitle()
    {
        return parent::getData(self::THIRD_DISPLAY_TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdTitle($title)
    {
        return $this->setData(self::THIRD_DISPLAY_TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdText()
    {
        return parent::getData(self::THIRD_TEXT);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdText($text)
    {
        return $this->setData(self::THIRD_TEXT, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdEmbedCode()
    {
        return parent::getData(self::THIRD_EMBED_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdEmbedCode($embedCode)
    {
        return $this->setData(self::THIRD_EMBED_CODE, $embedCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdTextPosition()
    {
        return parent::getData(self::THIRD_TEXT_POSITION);
    }

    /**
     * {@inheritdoc}
     */
    public function setThirdTextPosition($position)
    {
        return $this->setData(self::THIRD_TEXT_POSITION, $position);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstDesktopImageUrl($isSecureUrl = false)
    {
        return $this->getImageUrl($this->getFirstDesktopImageLocation(), $isSecureUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstMobileImageUrl($isSecureUrl = false)
    {
        return $this->getImageUrl($this->getFirstMobileImageLocation(), $isSecureUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondDesktopImageUrl($isSecureUrl = false)
    {
        return $this->getImageUrl($this->getSecondDesktopImageLocation(), $isSecureUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getSecondMobileImageUrl($isSecureUrl = false)
    {
        return $this->getImageUrl($this->getSecondMobileImageLocation(), $isSecureUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdDesktopImageUrl($isSecureUrl = false)
    {
        return $this->getImageUrl($this->getThirdDesktopImageLocation(), $isSecureUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getThirdMobileImageUrl($isSecureUrl = false)
    {
        return $this->getImageUrl($this->getThirdMobileImageLocation(), $isSecureUrl);
    }

    /**
     * @param string $imageLocation
     * @param bool $isSecureUrl
     * @return string
     */
    protected function getImageUrl($imageLocation, $isSecureUrl) {
        if (!$imageLocation) {
            return '';
        }

        $baseUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA, $isSecureUrl);

        return $baseUrl . $imageLocation;
    }

    /**
     * Returns an array of widths the original image should be resized to
     * @return array
     */
    protected function getSupportedSizes()
    {
        return self::SUPPORTED_IMAGE_SIZES;
    }

    /**
     * Resizes images to various sizes for later use in <img> srcsets
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

            $imageInfo = getimagesize($originalImagePath);

            $image
                ->fromFile($originalImagePath)
                ->resize($size)
                ->toFile($newFileName, $imageInfo['mime']);
        }
    }
}
