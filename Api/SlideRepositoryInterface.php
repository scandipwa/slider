<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api;

/**
 * Interface SlideRepositoryInterface
 */
interface SlideRepositoryInterface
{
    /**
     * @param int $id
     * @return \Scandiweb\Slider\Api\Data\SlideInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * @param \Scandiweb\Slider\Api\Data\SlideInterface $slider
     * @return \Scandiweb\Slider\Api\Data\SlideInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Scandiweb\Slider\Api\Data\SlideInterface $slide);

    /**
     * @param \Scandiweb\Slider\Api\Data\SlideInterface $slider
     * @return bool True on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Scandiweb\Slider\Api\Data\SlideInterface $slide);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @param int $storeId If present, then filters results by store
     * @return \Scandiweb\Slider\Api\Data\SlideSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        $storeId = 0
    );
}
