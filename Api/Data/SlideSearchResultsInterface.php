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
 * Interface SlideSearchResultsInterface
 */
interface SlideSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Scandiweb\Slider\Api\Data\SlideInterface[]
     */
    public function getItems();

    /**
     * @param \Scandiweb\Slider\Api\Data\SlideInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
