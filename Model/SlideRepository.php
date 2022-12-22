<?php

namespace Scandiweb\Slider\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Slider\Api\SlideRepositoryInterface;
use Scandiweb\Slider\Api\Data\SlideInterface;
use Scandiweb\Slider\Api\Data\SlideSearchResultsInterfaceFactory;
use Scandiweb\Slider\Model\ResourceModel\Slide as SlideResource;
use Scandiweb\Slider\Model\ResourceModel\Slide\CollectionFactory as SlideCollectionFactory;

/**
 * Class SlideRepository
 */
class SlideRepository implements SlideRepositoryInterface
{

    /**
     * @var SlideFactory
     */
    protected $slideFactory;

    /**
     * @var SlideResource
     */
    protected $slideResource;

    /**
     * @var SlideCollectionFactory
     */
    protected $slideCollectionFactory;

    /**
     * @var SlideSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @param SlideFactory $slideFactory
     * @param SlideResource $slideResource
     * @param SlideCollectionFactory $slideCollectionFactory
     * @param SlideSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        SlideFactory $slideFactory,
        SlideResource $slideResource,
        SlideCollectionFactory $slideCollectionFactory,
        SlideSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->slideFactory = $slideFactory;
        $this->slideResource = $slideResource;
        $this->slideCollectionFactory = $slideCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $slide = $this->slideFactory->create();
        $this->slideResource->load($slide, $id);

        if (!$slide->getId()) {
            throw new NoSuchEntityException(__('Slide with ID "%1" doesn\'t exist', $id));
        }

        return $slide;
    }

    /**
     * {@inheritdoc}
     */
    public function save(SlideInterface $slide)
    {
        $this->slideResource->save($slide);

        return $slide;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(SlideInterface $slide)
    {
        try {
            $this->slideResource->delete($slide);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete slide: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria, $storeId)
    {
        $collection = $this->slideCollectionFactory->create();

        if ($storeId) {
            $collection->addStoreFilter($storeId);
        }

        $this->collectionProcessor->process($searchCriteria, $collection);
        /** @var \Scandiweb\Slider\Api\Data\SlideSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}
