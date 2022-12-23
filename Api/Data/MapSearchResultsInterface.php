<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api\Data
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface MapSearchResultsInterface
 */
interface MapSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Scandiweb\Slider\Api\Data\MapInterface[]
     */
    public function getItems();

    /**
     * @param \Scandiweb\Slider\Api\Data\MapInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
