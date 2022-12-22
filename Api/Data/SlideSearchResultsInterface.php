<?php

namespace Scandiweb\Slider\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

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
