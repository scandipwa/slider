<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model\ResourceModel\Slider;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\Slider', 'Scandiweb\Slider\Model\ResourceModel\Slider');
    }

    /**
     * @return $this
     */
    protected function _afterLoadData()
    {
        parent::_afterLoadData();

        $collection = clone $this;

        if (count($collection)) {
            $this->_eventManager->dispatch('scandiweb_slider_slider_collection_load_after', ['collection' => $collection]);
        }

        return $this;
    }
}
