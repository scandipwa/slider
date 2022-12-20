<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api\Data
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api;

/**
 * Interface SliderRepositoryInterface
 */
interface SliderRepositoryInterface
{
    /**
     * @param int $id
     * @return \Scandiweb\Slider\Data\SliderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * @param \Scandiweb\Slider\Api\Data\SliderInterface $slider
     * @return \Scandiweb\Slider\Api\Data\SliderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Scandiweb\Slider\Api\Data\SliderInterface $slider);

    /**
     * @param \Scandiweb\Slider\Api\Data\SliderInterface $slider
     * @return bool True on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Scandiweb\Slider\Api\Data\SliderInterface $slider);
}
