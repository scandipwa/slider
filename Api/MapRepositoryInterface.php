<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api;

/**
 * Interface MapRepositoryInterface
 */
interface MapRepositoryInterface
{
    /**
     * @param int $id
     * @return \Scandiweb\Slider\Api\Data\MapInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * @param \Scandiweb\Slider\Api\Data\MapInterface $map
     * @return \Scandiweb\Slider\Api\Data\MapInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Scandiweb\Slider\Api\Data\MapInterface $map);

    /**
     * @param \Scandiweb\Slider\Api\Data\MapInterface $map
     * @return bool True on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Scandiweb\Slider\Api\Data\MapInterface $map);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @param int $sliderId If present will return only maps of the slider with this ID
     * @return \Scandiweb\Slider\Api\Data\SlideSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        $sliderId = 0
    );
}
