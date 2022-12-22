<?php

namespace Scandiweb\Slider\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Slider\Api\MapRepositoryInterface;
use Scandiweb\Slider\Api\Data\MapInterface;
use Scandiweb\Slider\Model\ResourceModel\Map as MapResource;

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

    public function __construct(
        MapFactory $mapFactory,
        MapResource $mapResource
    ) {
        $this->mapFactory = $mapFactory;
        $this->mapResource = $mapResource;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $map = $this->mapFactory->create();
        $this->sliderResource->load($map, $id);

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
}
