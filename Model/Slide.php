<?php
/**
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

declare(strict_types=1);

namespace Scandiweb\Slider\Model;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Scandiweb\Slider\Api\MapRepositoryInterface;
use Scandiweb\Slider\Api\Data\SlideInterface;
use Scandiweb\Slider\Model\ResourceModel\Slide as SlideResource;
use Scandiweb\Slider\Model\ResourceModel\Slide\Collection as SlideCollection;

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

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var MapRepositoryInterface
     */
    protected $mapRepository;

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slide');
    }

    /**
     * @param Context $context
     * @param Registry $registry
     * @param SlideResource $resource
     * @param SlideCollection $resourceCollection
     * @param StoreManagerInterface $storeManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param MapRepositoryInterface $mapRepository
     * @param FilterBuilder $filterBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        SlideResource $resource = null,
        SlideCollection $resourceCollection = null,
        StoreManagerInterface $storeManager,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        MapRepositoryInterface $mapRepository,
        FilterBuilder $filterBuilder,
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
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->mapRepository = $mapRepository;
        $this->filterBuilder = $filterBuilder;
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
    public function getSliderId()
    {
        return parent::getData(self::SLIDER_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setSliderId($id)
    {
        return $this->setData(self::SLIDER_ID, $id);
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
    public function getStartTime()
    {
        return parent::getData(self::START_TIME);
    }

    /**
     * {@inheritdoc}
     */
    public function setStartTime($startTime)
    {
        return $this->setData(self::START_TIME, $startTime);
    }

    /**
     * {@inheritdoc}
     */
    public function getEndTime()
    {
        return parent::getData(self::END_TIME);
    }

    /**
     * {@inheritdoc}
     */
    public function setEndTime($endTime)
    {
        return $this->setData(self::END_TIME, $endTime);
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
     * {@inheritdoc}
     */
    public function getMaps()
    {
        $searchCriteria = $this->getMapSearchCriteria();
        $searchResults = $this->mapRepository->getList($searchCriteria, $this->getSliderId());

        return $searchResults->getItems();
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

        foreach (self::SUPPORTED_IMAGE_SIZES as $size) {
            $newFileName = $fileNameParts['dirname'] . '/' .
                $fileNameParts['filename'] . '-' . $size . 'w.' . $fileNameParts['extension'];

            $imageInfo = getimagesize($originalImagePath);

            $image
                ->fromFile($originalImagePath)
                ->resize($size)
                ->toFile($newFileName, $imageInfo['mime']);
        }
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

        $baseUrl = $this->_storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA,
            $isSecureUrl
        );

        return $baseUrl . $imageLocation;
    }

    /**
     * Get search criteria for slide's maps
     * @return \Magento\Framework\Api\SearchCriteria
     */
    protected function getMapSearchCriteria()
    {
        // Using `main_table` because without it an error
        // is thrown that column names are too ambiguous
        $slideFilter = $this->filterBuilder
            ->setField('main_table.slide_id')
            ->setConditionType('eq')
            ->setValue((string) $this->getId())
            ->create();

        $isActiveFilter = $this->filterBuilder
            ->setField('main_table.is_active')
            ->setConditionType('eq')
            ->setValue('1')
            ->create();

        return $this->searchCriteriaBuilder
            ->addFilters([$slideFilter, $isActiveFilter])
            ->create();
    }
}
