<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model\ResourceModel\Map;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\Map', 'Scandiweb\Slider\Model\ResourceModel\Map');
    }

    /**
     * @param  bool $active
     * @return \Scandiweb\Slider\Model\ResourceModel\Map\Collection
     */
    public function addIsActiveFilter($active = true)
    {
        $this->getSelect()->where('main_table.is_active = ?', $active);

        return $this;
    }

    /**
     * @param  int $slideId
     * @return \Scandiweb\Slider\Model\ResourceModel\Map\Collection
     */
    public function addSlideFilter($slideId)
    {
        $this->addFieldToFilter('slide_id', $slideId);

        return $this;
    }

    /**
     * @param  int $sliderId
     * @return \Scandiweb\Slider\Model\ResourceModel\Map\Collection
     */
    public function addSliderFilter($sliderId)
    {
        $connection = $this->getConnection();

        $this->getSelect()
            ->join(
                ['sss' => $this->getTable('scandiweb_slider_slide')],
                $connection->quoteInto('main_table.slide_id = sss.slide_id AND sss.slider_id = ?', $sliderId),
                []
            );

        return $this;
    }
}
