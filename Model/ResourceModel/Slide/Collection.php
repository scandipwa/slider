<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model\ResourceModel\Slide;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var $_storeManager \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var $_localDate \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_localDate;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\DB\Adapter\AdapterInterface $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->_storeManager = $storeManager;
        $this->_localDate = $localeDate;
    }

    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\Slide', 'Scandiweb\Slider\Model\ResourceModel\Slide');
    }

    /**
     * @param  int $sliderId
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addSliderFilter($sliderId)
    {
        $this->addFieldToFilter('slider_id', $sliderId);

        return $this;
    }

    /**
     * @param  bool $isActive
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addIsActiveFilter($isActive = true)
    {
        $this->addFieldToFilter('is_active', $isActive);

        return $this;
    }

    /**
     * @param  int $storeId
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addStoreFilter($storeId = null)
    {
        if (is_null($storeId)) {
            $storeId = $this->_storeManager->getStore()->getId();
        }

        $this->getSelect()
            ->distinct()
            ->join(
                ['ss' => $this->getTable('scandiweb_slider_slide_store')],
                $this->getConnection()->quoteInto(
                    'main_table.slide_id = ss.slide_id AND (ss.store_id = ? OR ss.store_id = 0)',
                    $storeId
                ),
                []
        );

        return $this;
    }

    /**
     * Filter slides to retrieve only matching current date
     *
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addDateFilter()
    {
        $dateTime = $this->_localDate->date()->format('Y-m-d H:i:s');
        $this->getSelect()
            ->where('start_time <= ? OR start_time IS NULL', $dateTime)
            ->where('end_time >= ? OR end_time IS NULL', $dateTime);

        return $this;
    }

    /**
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addPositionOrder()
    {
        $this->getSelect()->order('position ASC');

        return $this;
    }

    /**
     * @return $this
     */
    protected function _afterLoadData()
    {
        parent::_afterLoadData();

        $collection = clone $this;

        if (count($collection)) {
            $this->_eventManager->dispatch('scandiweb_slider_slide_collection_load_after', ['collection' => $collection]);
        }

        return $this;
    }
}
