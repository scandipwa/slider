<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Model
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Slider\Api\SliderRepositoryInterface;
use Scandiweb\Slider\Api\Data\SliderInterface;
use Scandiweb\Slider\Model\ResourceModel\Slider as SliderResource;

/**
 * Class SliderRepository
 */
class SliderRepository implements SliderRepositoryInterface
{

    /**
     * @var SliderFactory
     */
    protected $sliderFactory;

    /**
     * @var SliderResource
     */
    protected $sliderResource;

    /**
     * @param SliderFactory $sliderFactory
     * @param SliderResource $sliderResource
     */
    public function __construct(
        SliderFactory $sliderFactory,
        SliderResource $sliderResource
    ) {
        $this->sliderFactory = $sliderFactory;
        $this->sliderResource = $sliderResource;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $slider = $this->sliderFactory->create();
        $this->sliderResource->load($slider, $id);

        if (!$slider->getId()) {
            throw new NoSuchEntityException(__('Slider with ID "%1" doesn\'t exist', $id));
        }

        return $slider;
    }

    /**
     * {@inheritdoc}
     */
    public function save(SliderInterface $slider)
    {
        $this->sliderResource->save($slider);

        return $slider;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(SliderInterface $slider)
    {
        try {
            $this->sliderResource->delete($slider);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete slider: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById(int $id)
    {
        try {
            $slider = $this->get($id);
            $this->sliderResource->delete($slider);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete slider: %1', $exception->getMessage())
            );
        }

        return true;
    }
}
