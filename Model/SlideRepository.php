<?php

namespace Scandiweb\Slider\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Slider\Api\SlideRepositoryInterface;
use Scandiweb\Slider\Api\Data\SlideInterface;
use Scandiweb\Slider\Model\ResourceModel\Slide as SlideResource;

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

    public function __construct(
        SlideFactory $slideFactory,
        SlideResource $slideResource
    ) {
        $this->slideFactory = $slideFactory;
        $this->slideResource = $slideResource;
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
}
