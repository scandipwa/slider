<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Model
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Slider\Api\MapRepositoryInterface;
use Scandiweb\Slider\Api\Data\MapInterface;
use Scandiweb\Slider\Api\Data\MapSearchResultsInterfaceFactory;
use Scandiweb\Slider\Model\ResourceModel\Map as MapResource;
use Scandiweb\Slider\Model\ResourceModel\Map\CollectionFactory as MapCollectionFactory;

/**
 * Class MapRepository
 */
class MapRepository implements MapRepositoryInterface
{

    /**
     * @var MapFactory
     */
    protected $mapFactory;

    /**
     * @var MapResource
     */
    protected $mapResource;

    /**
     * @var MapCollectionFactory
     */
    protected $mapCollectionFactory;

    /**
     * @var MapSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @param MapFactory $mapFactory
     * @param MapResource $mapResource
     * @param MapCollectionFactory $mapCollectionFactory
     * @param MapSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        MapFactory $mapFactory,
        MapResource $mapResource,
        MapCollectionFactory $mapCollectionFactory,
        MapSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->mapFactory = $mapFactory;
        $this->mapResource = $mapResource;
        $this->mapCollectionFactory = $mapCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $map = $this->mapFactory->create();
        $this->mapResource->load($map, $id);

        if (!$map->getId()) {
            throw new NoSuchEntityException(__('Map with ID "%1" doesn\'t exist', $id));
        }

        return $map;
    }

    /**
     * {@inheritdoc}
     */
    public function save(MapInterface $map)
    {
        $this->mapResource->save($map);

        return $map;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(MapInterface $map)
    {
        try {
            $this->mapResource->delete($map);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete map: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria, $sliderId = 0)
    {
        $collection = $this->mapCollectionFactory->create();

        if ($sliderId) {
            $collection->addSliderFilter($sliderId);
        }

        $this->collectionProcessor->process($searchCriteria, $collection);
        /** @var \Scandiweb\Slider\Api\Data\MapSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}
