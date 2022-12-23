<?php
/**
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Model;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Store\Model\StoreManagerInterface;
use Scandiweb\Slider\Api\MapRepositoryInterface;
use Scandiweb\Slider\Api\SlideRepositoryInterface;
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

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @var FilterGroupBuilder
     */
    protected $filterGroupBuilder;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var SlideRepositoryInterface
     */
    protected $slideRepository;

    /**
     * @var MapRepositoryInterface
     */
    protected $mapRepository;

    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slider');
    }

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param TimezoneInterface $timezone
     * @param StoreManagerInterface $storeManager
     * @param SlideRepositoryInterface $slideRepository
     * @param MapRepositoryInterface $mapRepository
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        TimezoneInterface $timezone,
        StoreManagerInterface $storeManager,
        SlideRepositoryInterface $slideRepository,
        MapRepositoryInterface $mapRepository
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->timezone = $timezone;
        $this->storeManager = $storeManager;
        $this->slideRepository = $slideRepository;
        $this->mapRepository = $mapRepository;
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

    /**
     * {@inheritdoc}
     */
    public function getSlides()
    {
        $searchCriteria = $this->getSlideSearchCriteria();
        $storeId = $this->storeManager->getStore()->getId();
        $searchResults = $this->slideRepository->getList($searchCriteria, $storeId);

        return $searchResults->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function getMaps()
    {
        $searchCriteria = $this->getMapSearchCriteria();
        $searchResults = $this->mapRepository->getList($searchCriteria);

        return $searchResults->getItems();
    }

    /**
     * Get search criteria for slides of this slider
     * @return \Magento\Framework\Api\SearchCriteria
     */
    protected function getSlideSearchCriteria()
    {
        $sliderFilter = $this->filterBuilder
            ->setField('slider_id')
            ->setConditionType('eq')
            ->setValue((string) $this->getId())
            ->create();

        $localDateTime = $this->timezone->date()->format('Y-m-d H:i:s');
        $startTimeFilter = $this->filterBuilder
            ->setField('start_time')
            ->setConditionType('lteq')
            ->setValue($localDateTime)
            ->create();

        $endTimeFilter = $this->filterBuilder
            ->setField('end_time')
            ->setConditionType('gteq')
            ->setValue($localDateTime)
            ->create();

        $startTimeNullFilter = $this->filterBuilder
            ->setField('start_time')
            ->setConditionType('null')
            ->create();

        $endTimeNullFilter = $this->filterBuilder
            ->setField('end_time')
            ->setConditionType('null')
            ->create();

        $startTimeGroup = $this->filterGroupBuilder
            ->setFilters([$startTimeFilter, $startTimeNullFilter])
            ->create();

        $endTimeGroup = $this->filterGroupBuilder
            ->setFilters([$endTimeFilter, $endTimeNullFilter])
            ->create();

        $isActiveFilter = $this->filterBuilder
            ->setField('is_active')
            ->setConditionType('eq')
            ->setValue('1');

        $positionSort = $this->sortOrderBuilder
            ->setField('position')
            ->create();

        return $this->searchCriteriaBuilder
            ->addFilters([$sliderFilter, $isActiveFilter])
            ->setFilterGroups([$startTimeGroup, $endTimeGroup])
            ->setSortOrders([$positionSort])
            ->create();
    }

    /**
     * Get search criteria for maps of this slider
     * @return \Magento\Framework\Api\SearchCriteria
     */
    protected function getMapSearchCriteria()
    {
        $sliderFilter = $this->filterBuilder
            ->setField('slider_id')
            ->setConditionType('eq')
            ->setValue((string) $this->getId())
            ->create();

        $isActiveFilter = $this->filterBuilder
            ->setField('is_active')
            ->setConditionType('eq')
            ->setValue('1')
            ->create();

        return $this->searchCriteriaBuilder
            ->addFilters([$sliderFilter, $isActiveFilter])
            ->create();
    }
}
